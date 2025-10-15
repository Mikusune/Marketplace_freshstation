<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\CartModel;
use Myth\Auth\Models\UserModel;

class CartController extends BaseController
{
    protected $cartModel;
    protected $userModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->userModel = new UserModel();
    }

    protected function getUser()
    {
        $user = null;
        if (user_id()) {
            $user = $this->userModel->find(user_id());
        }
        return $user;
    }

    public function addToCart($itemId)
    {
        if (!$this->getUser()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Please login first'
            ]);
        }

        $userId = user_id();
        
        // Get quantity from POST data or JSON request body
        $quantity = 1; // default value
        
        if ($this->request->getJSON()) {
            $quantity = $this->request->getJSON()->quantity ?? 1;
        } else if ($this->request->getPost('quantity')) {
            $quantity = $this->request->getPost('quantity');
        }

        // Validate quantity
        $quantity = intval($quantity);
        if ($quantity < 1) {
            $quantity = 1;
        }

        $data = [
            'user_id' => $userId,
            'id_item' => $itemId,
            'quantity' => $quantity
        ];

        try {
            $this->cartModel->addItem($data);
            
            // Get updated cart items for response
            $cartItems = $this->cartModel->getCartItems($userId);
            $cartTotal = $this->cartModel->getCartTotal($userId);
            $itemCount = $this->cartModel->getCartItemCount($userId);

            return $this->response->setJSON([
                'success' => true,
                'message' => $quantity . ' item(s) successfully added to cart',
                'cartItems' => $cartItems,
                'cartTotal' => $cartTotal,
                'itemCount' => $itemCount
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to add item to cart'
            ]);
        }
    }

    public function viewCart()
    {
        $user = $this->getUser();

        if (!$user) {
            return redirect()->to('/login');
        }

        $userId = $user->id;
        $cartItems = $this->cartModel->getCartItems($userId);
        $cartTotal = $this->cartModel->getCartTotal($userId);
        // Ambil alamat user
        $addressModel = new \App\Models\AddressModel();
        $userAddresses = $addressModel->where('user_id', $userId)->findAll();

        $data = [
            'cartItems' => $cartItems,
            'cartTotal' => $cartTotal,
            'user' => $user,
            'userAddresses' => $userAddresses
        ];

        return view('templates_customer/header', ['user' => $user])
           . view('customer/cart', $data)
           . view('templates_customer/footer');
    }

    public function updateQuantity($cartId)
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Please login first'
            ]);
        }

        $quantity = (int)$this->request->getPost('quantity');
        
        if ($quantity < 1) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid quantity'
            ]);
        }

        try {
            $this->cartModel->updateQuantity($cartId, $quantity);
            
            // Get updated cart data
            $cartItems = $this->cartModel->getCartItems($user->id);
            $cartTotal = $this->cartModel->getCartTotal($user->id);

            // Find the updated item's subtotal with discount
            $updatedItem = array_filter($cartItems, function($item) use ($cartId) {
                return $item['id'] == $cartId;
            });
            
            $updatedItem = reset($updatedItem);
            $price = $updatedItem['harga_jual'];
            if (isset($updatedItem['discount_percentage']) && $updatedItem['discount_percentage'] > 0) {
                $price = $price - ($price * $updatedItem['discount_percentage'] / 100);
            }
            $itemSubtotal = $price * $quantity;

            return $this->response->setJSON([
                'success' => true,
                'cartTotal' => $cartTotal,
                'itemSubtotal' => $itemSubtotal
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to update quantity'
            ]);
        }
    }

    public function deleteItem($cartId)
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Please login first'
            ]);
        }

        try {
            $this->cartModel->deleteItem($cartId);
            
            // Get updated cart total
            $cartTotal = $this->cartModel->getCartTotal($user->id);
            $itemCount = $this->cartModel->getCartItemCount($user->id);

            return $this->response->setJSON([
                'success' => true,
                'cartTotal' => $cartTotal,
                'itemCount' => $itemCount
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to remove item'
            ]);
        }
    }

    /**
     * AJAX endpoint untuk reload isi keranjang di header
     */
    public function viewCartAjax()
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->response->setStatusCode(401)->setBody('Silakan login terlebih dahulu');
        }
        $userId = $user->id;
        $cartItems = $this->cartModel->getCartItems($userId);
        $cartTotal = $this->cartModel->getCartTotal($userId);
        // Render hanya isi offcanvas cart
        return view('customer/partials/offcanvas_cart', [
            'cartItems' => $cartItems,
            'cartTotal' => $cartTotal
        ]);
    }
}
