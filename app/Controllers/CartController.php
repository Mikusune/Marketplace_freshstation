<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class CartController extends Controller
{
    // ...existing code...

    public function add() {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        $productId = $this->request->getJSON()->product_id;
        $quantity = $this->request->getJSON()->quantity ?? 1;

        // Get product details from database
        $db = \Config\Database::connect();
        $product = $db->table('item')
                      ->where('id_item', $productId)
                      ->get()
                      ->getRowArray();

        if (!$product) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Product not found'
            ]);
        }

        // Get current cart from session
        $cartItems = session('cartItems') ?? [];
        $cartTotal = session('cartTotal') ?? 0;

        // Check if product already exists in cart
        $found = false;
        foreach ($cartItems as &$item) {
            if ($item['id_item'] == $productId) {
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }

        // If product not found in cart, add it
        if (!$found) {
            $cartItems[] = [
                'id_item' => $product['id_item'],
                'nama_produk' => $product['nama_produk'],
                'harga' => $product['harga'],
                'quantity' => $quantity,
            ];
        }

        // Calculate total
        $cartTotal = 0;
        foreach ($cartItems as $item) {
            $cartTotal += $item['harga'] * $item['quantity'];
        }

        // Save updated cart to session
        session()->set('cartItems', $cartItems);
        session()->set('cartTotal', $cartTotal);

        // Return cart data
        return $this->response->setJSON([
            'success' => true,
            'cart' => [
                'items' => $cartItems,
                'total' => $cartTotal,
                'count' => count($cartItems)
            ]
        ]);
    }

    // ...existing code...
}