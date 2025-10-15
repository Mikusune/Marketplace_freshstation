<?php
namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\UserAddressModel;


class AddressController extends BaseController
{
    protected $addressModel;

    public function __construct()
    {
        $this->addressModel = new UserAddressModel();
    }

    // Tampilkan halaman kelola alamat
    public function index()
    {
        $userId = function_exists('user_id') ? user_id() : session('user_id');
        $addresses = $this->addressModel->where('user_id', $userId)->findAll();
        return view('customer/addresses', ['addresses' => $addresses]);
    }

    // Simpan alamat baru
    public function saveAddress()
    {
        $userId = function_exists('user_id') ? user_id() : session('user_id');
        $data = $this->request->getJSON();
        if (!$userId || !$data || empty($data->address) || empty($data->latitude) || empty($data->longitude)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data tidak lengkap']);
        }
        $this->addressModel->insert([
            'user_id' => $userId,
            'address' => $data->address,
            'latitude' => $data->latitude,
            'longitude' => $data->longitude
        ]);
        return $this->response->setJSON(['success' => true]);
    }

    // Update alamat
    public function updateAddress()
    {
        $userId = function_exists('user_id') ? user_id() : session('user_id');
        $data = $this->request->getJSON();
        if (!$userId || !$data || empty($data->id) || empty($data->address) || empty($data->latitude) || empty($data->longitude)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data tidak lengkap']);
        }
        $address = $this->addressModel->where('id', $data->id)->where('user_id', $userId)->first();
        if (!$address) {
            return $this->response->setJSON(['success' => false, 'message' => 'Alamat tidak ditemukan']);
        }
        $this->addressModel->update($data->id, [
            'address' => $data->address,
            'latitude' => $data->latitude,
            'longitude' => $data->longitude
        ]);
        return $this->response->setJSON(['success' => true]);
    }

    // Hapus alamat
    public function deleteAddress($id)
    {
        $userId = function_exists('user_id') ? user_id() : session('user_id');
        $address = $this->addressModel->where('id', $id)->where('user_id', $userId)->first();
        if (!$address) {
            return $this->response->setJSON(['success' => false, 'message' => 'Alamat tidak ditemukan']);
        }
        $this->addressModel->delete($id);
        return $this->response->setJSON(['success' => true]);
    }
}
