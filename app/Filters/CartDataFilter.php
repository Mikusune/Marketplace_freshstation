<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CartModel;

class CartDataFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Jika user sudah login
        if (user_id()) {
            $cartModel = new CartModel();
            $cartItems = $cartModel->getCartItems(user_id());
            
            $cartTotal = 0;
            foreach ($cartItems as $item) {
                $cartTotal += $item['harga_jual'] * $item['quantity'];
            }

            // Set data ke session
            session()->set([
                'cartItems' => $cartItems,
                'cartTotal' => $cartTotal
            ]);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
