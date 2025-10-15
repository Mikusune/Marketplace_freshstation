<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use Midtrans\Transaction;

class OrderController extends BaseController
{
    protected $orderModel;
    protected $orderItemModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->orderItemModel = new OrderItemModel();
    }

    public function index()
    {
        if (!user_id()) {
            return redirect()->to('/login');
        }

        $orders = $this->orderModel->getOrdersByUserId(user_id());

        // Update status dari Midtrans untuk setiap order
        foreach ($orders as $order) {
            try {
                // Konversi response Midtrans ke object
                $midtransStatus = (object) Transaction::status($order->order_id);
                if ($midtransStatus && $order->transaction_status !== $midtransStatus->transaction_status) {
                    $this->orderModel->update($order->id, [
                        'transaction_status' => $midtransStatus->transaction_status,
                        'payment_type' => $midtransStatus->payment_type ?? null
                    ]);
                    $order->transaction_status = $midtransStatus->transaction_status;
                    $order->payment_type = $midtransStatus->payment_type ?? null;
                }
            } catch (\Exception $e) {
                log_message('error', 'Midtrans Error: ' . $e->getMessage());
            }
        }

        $data = [
            'orders' => $orders
        ];

        return view('templates_customer/header')
            . view('customer/orders', $data)
            . view('templates_customer/footer');
    }

    public function detail($id)
    {
        if (!user_id()) {
            return redirect()->to('/login');
        }

        $order = $this->orderModel->getOrderWithItems($id);
        
        if (!$order || $order->user_id !== user_id()) {
            return redirect()->to('/customer/orders')->with('error', 'Order tidak ditemukan');
        }

        try {
            // Konversi response Midtrans ke object
            $midtransStatus = (object) Transaction::status($order->order_id);
            if ($midtransStatus && $order->transaction_status !== $midtransStatus->transaction_status) {
                $this->orderModel->update($order->id, [
                    'transaction_status' => $midtransStatus->transaction_status,
                    'payment_type' => $midtransStatus->payment_type ?? null
                ]);
                $order->transaction_status = $midtransStatus->transaction_status;
                $order->payment_type = $midtransStatus->payment_type ?? null;
            }
        } catch (\Exception $e) {
            log_message('error', 'Midtrans Error: ' . $e->getMessage());
        }

        $data = [
            'order' => $order
        ];

        return view('templates_customer/header')
            . view('customer/order_detail', $data)
            . view('templates_customer/footer');
    }
}