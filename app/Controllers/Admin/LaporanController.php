<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LaporanModel;
use Myth\Auth\Models\UserModel;

class LaporanController extends BaseController
{   
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function penjualan()
    {   
        $user = null;
        if (user_id()) {
            $user = $this->userModel->find(user_id());
        }
        $tanggal_mulai = $this->request->getGet('tanggal_mulai') ?? date('Y-m-01');
        $tanggal_akhir = $this->request->getGet('tanggal_akhir') ?? date('Y-m-d');
        $model = new LaporanModel();
        $dataLaporan = $model->getLaporanPenjualan($tanggal_mulai, $tanggal_akhir);

        $total_penjualan = 0;
        $total_modal = 0;
        $total_keuntungan = 0;
        foreach ($dataLaporan as $row) {
            $total_penjualan += $row['subtotal_penjualan'];
            $total_modal += $row['subtotal_modal'];
            $total_keuntungan += $row['keuntungan'];
        }

        $data = [
            'laporan' => $dataLaporan,
            'total_penjualan' => $total_penjualan,
            'total_modal' => $total_modal,
            'total_keuntungan' => $total_keuntungan,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_akhir' => $tanggal_akhir,
            'user' => $user,
        ];
        return view('admin/laporan/penjualan', $data);
    }
}
