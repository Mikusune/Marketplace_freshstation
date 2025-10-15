<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ShippingModel;

class ShippingController extends BaseController
{
    public function index()
    {
        $model = new ShippingModel();
        $config = $model->first();
        return view('admin/shipping_config', ['config' => $config]);
    }

    public function update()
    {
        $model = new ShippingModel();
        $price = $this->request->getPost('price_per_km');
        $model->update(1, ['price_per_km' => $price]);
        return redirect()->to('/admin/shipping')->with('success', 'Harga ongkir per km berhasil diupdate!');
    }
}
