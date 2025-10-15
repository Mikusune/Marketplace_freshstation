<?php

namespace App\Controllers;

use App\Models\CartModel;
use Myth\Auth\Models\UserModel;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends BaseController
{   
    protected $cartModel;
    protected $userModel;
    public function __construct()
    {
        // Load konfigurasi Midtrans
        $this->cartModel = new CartModel();
        $this->userModel = new UserModel();
        Config::$serverKey = 'SB-Mid-server-Rxhi0JI2-vF0CN8tGmhfKX9o'; // Ganti dengan Server Key Anda
        Config::$clientKey = 'SB-Mid-client-eQPe2gFThFqam1O-'; // Ganti dengan Client Key Anda
        Config::$isProduction = false; // Set true jika Anda menggunakan mode production
    }

    protected function getUser()
    {
        $user = null;
        if (user_id()) {  // user_id() adalah fungsi global dari Myth\Auth untuk mendapatkan user_id
            $user = $this->userModel->find(user_id()); // Ambil data user berdasarkan user_id
        }
        return $user;
    }

    public function createTransaction()
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User not authenticated'
            ]);
        }

        $json = $this->request->getJSON();
        
        // Get shipping information
        $address = $json->address;
        $courier = $json->courier;
        $shipping_cost = $json->shipping_cost;
        $total_amount = $json->total_amount;
        $items = $json->items;

        // Generate unique order ID
        $order_id = 'ORDER-' . time() . '-' . $user->id;

        // Prepare customer details
        $customer_details = [
            'first_name' => $user->username,
            'email' => $user->email,
            'shipping_address' => [
                'address' => $address,
                'courier' => $courier
            ]
        ];

        // Prepare item details
        $item_details = [];
        foreach ($items as $item) {
            $item_details[] = [
                'id' => $item->id_item,
                'price' => $item->harga,
                'quantity' => $item->quantity,
                'name' => $item->nama_produk
            ];
        }

        // Add shipping cost as an item
        $item_details[] = [
            'id' => 'SHIPPING',
            'price' => $shipping_cost,
            'quantity' => 1,
            'name' => strtoupper($courier) . ' Shipping Cost'
        ];

        // Create transaction data
        $transaction_details = [
            'order_id' => $order_id,
            'gross_amount' => $total_amount
        ];

        // Combine all data
        $transaction_data = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
            'custom_field1' => $courier,
            'custom_field2' => $address
        ];

        // Get Snap Token
        \Midtrans\Config::$serverKey = getenv('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false;
        
        try {
            $snapToken = \Midtrans\Snap::getSnapToken($transaction_data);
            return $this->response->setJSON([
                'success' => true,
                'snapToken' => $snapToken
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to create transaction: ' . $e->getMessage()
            ]);
        }
    }

    public function index()
    {
        return view('payment');
    }
}