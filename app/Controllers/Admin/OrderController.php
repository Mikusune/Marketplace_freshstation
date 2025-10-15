<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use Myth\Auth\Models\UserModel;
use Midtrans\Transaction;
use Config\Midtrans as MidtransConfig;
use Midtrans\Config;

class OrderController extends BaseController
{
    protected $orderModel;
    protected $orderItemModel;
    protected $userModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->orderItemModel = new OrderItemModel();
        $this->userModel = new UserModel();

        // Inisialisasi konfigurasi Midtrans
        $midtransConfig = new MidtransConfig();
        Config::$serverKey = $midtransConfig->serverKey;
        Config::$isProduction = $midtransConfig->isProduction;
    }

    public function index()
    {
        $user = null;
        if (user_id()) {
            $user = $this->userModel->find(user_id());
        }

        $orders = $this->orderModel->select('orders.*, users.username, users.email')
                                 ->join('users', 'users.id = orders.user_id')
                                 ->orderBy('orders.created_at', 'DESC')
                                 ->findAll();

        // Update status dari Midtrans untuk setiap order
        foreach ($orders as $order) {
            try {
                // Log current status
                log_message('debug', 'Current order status: Order ID=' . $order->order_id . ', Status=' . $order->transaction_status);
                
                // Ambil status dari Midtrans
                $midtransStatus = Transaction::status($order->order_id);
                
                // Log Midtrans response
                log_message('debug', 'Midtrans response: ' . json_encode($midtransStatus));

                if ($midtransStatus && $order->transaction_status !== $midtransStatus->transaction_status) {
                    log_message('info', 'Updating order status: ' . $order->order_id . 
                              ' from ' . $order->transaction_status . 
                              ' to ' . $midtransStatus->transaction_status);

                    $this->orderModel->update($order->id, [
                        'transaction_status' => $midtransStatus->transaction_status,
                        'payment_type' => isset($midtransStatus->payment_type) ? $midtransStatus->payment_type : null
                    ]);
                    
                    $order->transaction_status = $midtransStatus->transaction_status;
                    $order->payment_type = isset($midtransStatus->payment_type) ? $midtransStatus->payment_type : null;
                }
            } catch (\Exception $e) {
                log_message('error', 'Midtrans Error for order ' . $order->order_id . ': ' . $e->getMessage());
                log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            }
        }

        $data = [
            'title' => 'Manage Orders',
            'orders' => $orders
        ];

        return view('templates_admin/header', ['user' => $user])
            . view('templates_admin/sidebar')
            . view('admin/orders/index', $data)
            . view('templates_admin/footer');
    }

    public function detail($id)
    {
        $user = null;
        if (user_id()) {
            $user = $this->userModel->find(user_id());
        }

        $order = $this->orderModel->select('orders.*, users.username, users.email')
                                ->join('users', 'users.id = orders.user_id')
                                ->where('orders.id', $id)
                                ->first();

        if (!$order) {
            return redirect()->to('/admin/orders')->with('error', 'Order tidak ditemukan');
        }

        $orderItems = $this->orderItemModel->getItemsByOrderId($id);
        
        try {
            $midtransStatus = Transaction::status($order->order_id);
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
            'title' => 'Order Detail',
            'order' => $order,
            'items' => $orderItems
        ];

        return view('templates_admin/header', ['user' => $user])
            . view('templates_admin/sidebar')
            . view('admin/orders/detail', $data)
            . view('templates_admin/footer');
    }

    public function updateStatus($id)
    {
        try {
            $order = $this->orderModel->find($id);
            if (!$order) {
                return redirect()->to('/admin/orders')->with('error', 'Order tidak ditemukan');
            }

            $status = $this->request->getPost('status');
            $validStatuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];

            if (!in_array($status, $validStatuses)) {
                return redirect()->back()->with('error', 'Status tidak valid');
            }

            // Log before update
            log_message('debug', 'Updating order ' . $id . ' shipping status from ' . ($order->shipping_status ?? 'null') . ' to ' . $status);

            $updated = $this->orderModel->update($id, [
                'shipping_status' => $status,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            if ($updated) {
                return redirect()->back()->with('success', 'Status order berhasil diupdate');
            } else {
                log_message('error', 'Failed to update order status. Order ID: ' . $id);
                return redirect()->back()->with('error', 'Gagal mengupdate status order');
            }
        } catch (\Exception $e) {
            log_message('error', 'Error updating order status: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate status');
        }
    }
}