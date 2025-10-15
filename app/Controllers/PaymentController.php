<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use Myth\Auth\Models\UserModel;
use Config\Midtrans as MidtransConfig;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends BaseController
{   
    protected $cartModel;
    protected $userModel;
    protected $orderModel;
    protected $orderItemModel;
    protected $midtransConfig;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->userModel = new UserModel();
        $this->orderModel = new OrderModel();
        $this->orderItemModel = new OrderItemModel();
        
        // Load konfigurasi Midtrans dari file config
        $this->midtransConfig = new MidtransConfig();
        Config::$serverKey = $this->midtransConfig->serverKey;
        Config::$clientKey = $this->midtransConfig->clientKey;
        Config::$isProduction = $this->midtransConfig->isProduction;
    }

    protected function getUser()
    {
        $user = null;
        if (user_id()) {
            $user = $this->userModel->find(user_id());
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
    $shipping_cost = (int)$json->shipping_cost;
    $total_amount = (int)$json->total_amount;
    $items = $json->items;

        // Generate unique order ID
        $order_id = 'ORDER-' . time() . '-' . $user->id;

        // Save order to database
        $orderData = [
            'user_id' => $user->id,
            'order_id' => $order_id,
            'gross_amount' => $total_amount,
            'shipping_address' => $address,
            'shipping_cost' => $shipping_cost,
            'transaction_status' => 'pending'
        ];

        $this->orderModel->insert($orderData);
        $savedOrderId = $this->orderModel->insertID();

        // Save order items
        foreach ($items as $item) {
            $this->orderItemModel->insert([
                'order_id' => $savedOrderId,
                'item_id' => $item->id_item,
                'quantity' => $item->quantity,
                'price' => $item->harga_jual
            ]);
        }

        // Prepare customer details for Midtrans
        $customer_details = [
            'first_name' => $user->username,
            'email' => $user->email,
            'shipping_address' => [
                'address' => $address
            ]
        ];

        // Prepare item details for Midtrans
        $item_details = [];
        foreach ($items as $item) {
            $item_details[] = [
                'id' => $item->id_item,
                'price' => (int)$item->harga_jual,
                'quantity' => (int)$item->quantity,
                'name' => $item->nama_produk
            ];
        }

        // Add shipping cost as an item
        $item_details[] = [
            'id' => 'SHIPPING-TOKO',
            'price' => $shipping_cost,
            'quantity' => 1,
            'name' => 'Ongkir Toko'
        ];

        // Create transaction data for Midtrans
        $transaction_data = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $total_amount
            ],
            'customer_details' => $customer_details,
            'item_details' => $item_details
        ];
        
        try {
            $snapToken = Snap::getSnapToken($transaction_data);

            // Clear cart after successful order creation
            $this->cartModel->where('user_id', $user->id)->delete();

            return $this->response->setJSON([
                'success' => true,
                'snapToken' => $snapToken
            ]);
        } catch (\Exception $e) {
            // Delete order if Midtrans token generation fails
            $this->orderModel->delete($savedOrderId);
            
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
    // Endpoint untuk menerima notifikasi dari Midtrans
    public function notificationHandler()
    {
        $json = $this->request->getJSON();
        if (!$json) {
            return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'Invalid payload']);
        }

        $orderId = $json->order_id ?? null;
        $transactionStatus = $json->transaction_status ?? null;

        if (!$orderId || !$transactionStatus) {
            return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'Missing order_id or transaction_status']);
        }

        // Hanya update stok jika pembayaran sukses
        if (in_array($transactionStatus, ['settlement', 'capture'])) {
            $orderModel = new \App\Models\OrderModel();
            $orderItemModel = new \App\Models\OrderItemModel();
            $itemModel = new \App\Models\ItemModel();

            $order = $orderModel->where('order_id', $orderId)->first();
            if (!$order) {
                return $this->response->setStatusCode(404)->setJSON(['success' => false, 'message' => 'Order not found']);
            }

            $orderItems = $orderItemModel->where('order_id', $order->id)->findAll();
            foreach ($orderItems as $item) {
                $itemModel->where('id_item', $item['item_id'])
                    ->set('stok', 'stok - ' . (int)$item['quantity'], false)
                    ->update();
            }
        }

        return $this->response->setJSON(['success' => true]);
    }
    // Endpoint untuk update stok via JS setelah pembayaran sukses (tidak disarankan untuk produksi)
    public function updateStockAfterPayment()
    {
        $json = $this->request->getJSON();
        $orderId = $json->order_id ?? null;
        if (!$orderId) {
            return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'order_id required']);
        }

        $orderModel = new \App\Models\OrderModel();
        $orderItemModel = new \App\Models\OrderItemModel();
        $itemModel = new \App\Models\ItemModel();

        $order = $orderModel->where('order_id', $orderId)->first();
        if (!$order) {
            return $this->response->setStatusCode(404)->setJSON(['success' => false, 'message' => 'Order not found']);
        }

        $orderItems = $orderItemModel->where('order_id', $order->id)->findAll();
        foreach ($orderItems as $item) {
            $itemModel->where('id_item', $item->item_id)
                ->set('stok', 'stok - ' . (int)$item->quantity, false)
                ->update();
        }
        return $this->response->setJSON(['success' => true]);
    }
}