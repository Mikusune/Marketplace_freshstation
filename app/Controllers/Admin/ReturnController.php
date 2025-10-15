<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ReturnModel;
use Myth\Auth\Models\UserModel;

class ReturnController extends BaseController
{   
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $returnModel = new ReturnModel();
        $orderModel = new \App\Models\OrderModel();
        $user = $this->userModel->find(user_id());
        $returns = $returnModel->orderBy('created_at', 'DESC')->findAll();
        // Tambahkan midtrans_order_id ke setiap return
        foreach ($returns as &$r) {
            $order = $orderModel->find($r['order_id']);
            $r['midtrans_order_id'] = $order ? $order->order_id : '-';
        }
        $data = [
            'returns' => $returns,
            'user' => $user,
        ];
        return view('admin/returns/index', $data);
    }

    public function detail($id)
    {
        $returnModel = new ReturnModel();
        $orderItemModel = new \App\Models\OrderItemModel();
        $orderModel = new \App\Models\OrderModel();
        $return = $returnModel->find($id);
        // Ambil user yang melakukan pengembalian
        $user = $this->userModel->find($return['user_id']);
        // Ambil barang-barang pada pesanan terkait
        $items = $orderItemModel->getItemsByOrderId($return['order_id']);
        // Ambil order Midtrans order_id string
        $order = $orderModel->find($return['order_id']);
        $midtransOrderId = $order ? $order->order_id : null;
        // Pastikan $user dalam bentuk array
        if (is_object($user)) {
            $user = $user->toArray();
        }
        $data = [
            'return' => $return,
            'user' => $user,
            'items' => $items,
            'midtrans_order_id' => $midtransOrderId,
        ];
        return view('admin/returns/detail', $data);
    }

    public function update_status($id)
    {
        $returnModel = new ReturnModel();
        $status = $this->request->getPost('status');
        $returnModel->update($id, ['status' => $status]);
        return redirect()->to('/admin/returns')->with('pesan', 'Status pengembalian diperbarui.');
    }

    // Proses refund Midtrans hanya jika return_type = 'refund'
    public function proses($id)
    {
        $decision = $this->request->getPost('keputusan');
        $returnModel = new ReturnModel();
        $orderModel = new \App\Models\OrderModel();

        $ret = $returnModel->find($id);
        if (!$ret) {
            return redirect()->to('/admin/returns')->with('error', 'Pengajuan tidak ditemukan.');
        }

        if ($decision === 'tolak') {
            $returnModel->update($id, ['status' => 'rejected']);
            return redirect()->to('/admin/returns')->with('pesan', 'Pengajuan pengembalian ditolak.');
        }

        // Jika setuju dan opsi refund, lakukan refund Midtrans
        if ($decision === 'setuju') {
            if (($ret['return_type'] ?? '') === 'refund') {
                // --- Midtrans refund logic (reuse existing logic) ---
                $order = $orderModel->where('id', $ret['order_id'])->first();
                if (!$order) {
                    $order = $orderModel->where('order_id', $ret['order_id'])->first();
                }
                if (!$order) {
                    $returnModel->update($id, ['status' => 'pending']);
                    return redirect()->to('/admin/returns')->with('error', 'Order terkait tidak ditemukan, pengembalian tidak diproses.');
                }
                $midtransConfig = new \Config\Midtrans();
                \Midtrans\Config::$serverKey = $midtransConfig->serverKey;
                \Midtrans\Config::$isProduction = $midtransConfig->isProduction;
                try {
                    $midtransOrderId = $order->order_id ?? $order['order_id'] ?? null;
                    if (!$midtransOrderId) {
                        throw new \Exception('order_id Midtrans tidak tersedia pada order.');
                    }
                    $status = (object) \Midtrans\Transaction::status($midtransOrderId);
                    if (!in_array($status->transaction_status ?? '', ['settlement', 'capture'])) {
                        return redirect()->to('/admin/returns')->with('error', 'Transaksi belum dapat di-refund (status: ' . ($status->transaction_status ?? 'unknown') . ').');
                    }
                    $amount = (int) ($order->gross_amount ?? $order['gross_amount'] ?? 0);
                    if ($amount <= 0) {
                        throw new \Exception('Nominal refund tidak tersedia pada order.');
                    }
                    $params = [
                        'refund_key' => 'return-' . $id . '-' . time(),
                        'amount' => $amount,
                    ];
                    $refundResponse = \Midtrans\Transaction::refund($midtransOrderId, $params);
                    $returnModel->update($id, ['status' => 'approved', 'updated_at' => date('Y-m-d H:i:s')]);
                    $orderModel->update($order->id ?? $order['id'], ['transaction_status' => 'refunded']);
                    return redirect()->to('/admin/returns')->with('pesan', 'Pengembalian dana disetujui dan refund dikirim ke Midtrans.');
                } catch (\Exception $e) {
                    $short = 'Gagal melakukan refund: ' . $e->getMessage();
                    $msg = $e->getMessage();
                    $detail = $msg;
                    if (preg_match('/\{.*\}/s', $msg, $m)) {
                        $detail = $m[0];
                    }
                    return redirect()->to('/admin/returns')->with('error', $short)->with('error_detail', $detail);
                }
            } else {
                // Opsi penggantian barang, hanya update status
                $returnModel->update($id, ['status' => 'approved', 'updated_at' => date('Y-m-d H:i:s')]);
                return redirect()->to('/admin/returns')->with('pesan', 'Pengajuan penggantian barang disetujui.');
            }
        }
        return redirect()->to('/admin/returns')->with('error', 'Keputusan tidak dikenali.');
    }

        // Manual refund trigger for admin button
    public function refund($id)
    {
        $returnModel = new ReturnModel();
        $orderModel = new \App\Models\OrderModel();
        $ret = $returnModel->find($id);
        if (!$ret) {
            return redirect()->back()->with('error', 'Pengajuan tidak ditemukan.');
        }
        if (($ret['return_type'] ?? '') !== 'refund') {
            return redirect()->back()->with('error', 'Opsi pengembalian bukan refund.');
        }
        $order = $orderModel->where('id', $ret['order_id'])->first();
        if (!$order) {
            $order = $orderModel->where('order_id', $ret['order_id'])->first();
        }
        if (!$order) {
            return redirect()->back()->with('error', 'Order terkait tidak ditemukan.');
        }
        $midtransConfig = new \Config\Midtrans();
        \Midtrans\Config::$serverKey = $midtransConfig->serverKey;
        \Midtrans\Config::$isProduction = $midtransConfig->isProduction;
        try {
            $midtransOrderId = $order->order_id ?? $order['order_id'] ?? null;
            if (!$midtransOrderId) {
                throw new \Exception('order_id Midtrans tidak tersedia pada order.');
            }
            $status = (object) \Midtrans\Transaction::status($midtransOrderId);
            if (!in_array($status->transaction_status ?? '', ['settlement', 'capture'])) {
                return redirect()->back()->with('error', 'Transaksi belum dapat di-refund (status: ' . ($status->transaction_status ?? 'unknown') . ').');
            }
            $amount = (int) ($order->gross_amount ?? $order['gross_amount'] ?? 0);
            if ($amount <= 0) {
                throw new \Exception('Nominal refund tidak tersedia pada order.');
            }
            $params = [
                'refund_key' => 'return-' . $id . '-' . time(),
                'amount' => $amount,
            ];
            $refundResponse = \Midtrans\Transaction::refund($midtransOrderId, $params);
            $returnModel->update($id, ['status' => 'approved', 'updated_at' => date('Y-m-d H:i:s')]);
            $orderModel->update($order->id ?? $order['id'], ['transaction_status' => 'refunded']);
            return redirect()->back()->with('pesan', 'Refund berhasil dan dikirim ke Midtrans.');
        } catch (\Exception $e) {
            $short = 'Gagal melakukan refund: ' . $e->getMessage();
            $msg = $e->getMessage();
            $detail = $msg;
            if (preg_match('/\{.*\}/s', $msg, $m)) {
                $detail = $m[0];
            }
            return redirect()->back()->with('error', $short)->with('error_detail', $detail);
        }
    }
}
