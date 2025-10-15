<?php

namespace App\Controllers;

use App\Models\OrderModel;
use Midtrans\Config;
use Midtrans\Transaction;

class AdminController extends BaseController
{
    protected $orderModel;

    public function __construct()
    {
        // Load konfigurasi Midtrans dari config
        $midtransConfig = new \Config\Midtrans();
        Config::$serverKey = $midtransConfig->serverKey;
        Config::$isProduction = $midtransConfig->isProduction;
        
        $this->orderModel = new OrderModel();
    }

    public function transactions()
    {
        // Ambil semua order yang ada di database
        $orders = $this->orderModel->findAll();
        $transactions = [];

        // Ambil status untuk setiap order
        foreach ($orders as $order) {
            try {
                // Konversi response Midtrans ke object
                $midtransStatus = (object) Transaction::status($order->order_id);
                $transactions[] = $midtransStatus;

                // Update status transaksi di database jika berbeda
                if ($order->transaction_status !== $midtransStatus->transaction_status) {
                    $this->orderModel->update($order->id, [
                        'transaction_status' => $midtransStatus->transaction_status,
                        'payment_type' => $midtransStatus->payment_type ?? null
                    ]);
                }
            } catch (\Exception $e) {
                log_message('error', 'Midtrans Error: ' . $e->getMessage());
                // Tambahkan object error ke array transactions
                $transactions[] = (object) [
                    'order_id' => $order->order_id,
                    'error' => 'Failed to get transaction status: ' . $e->getMessage()
                ];
            }
        }

        return view('transactions', ['transactions' => $transactions]);
    }
}