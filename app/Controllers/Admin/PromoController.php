<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PromoModel;
use App\Models\ItemModel;
use Myth\Auth\Models\UserModel;
use App\Models\category_model;

class PromoController extends BaseController
{
    protected $promoModel;
    protected $itemModel;
    protected $userModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->promoModel = new PromoModel();
        $this->itemModel = new ItemModel();
        $this->userModel = new UserModel();
        $this->categoryModel = new category_model();
    }

    public function index()
    {
        $user = $this->userModel->find(user_id());
        $data = [
            'user' => $user,
            'promos' => $this->promoModel->getAllPromos(),
            'types' => $this->itemModel->getAllTypes(),
        ];

        return view('templates_admin/header', $data)
            . view('templates_admin/sidebar', $data)
            . view('admin/Data_promo', $data)
            . view('templates_admin/footer');
    }

    public function tambah()
    {
        $user = $this->userModel->find(user_id());
        $data = [
            'user' => $user,
            'available_items' => $this->promoModel->getAvailableItems(),
            'types' => $this->itemModel->getAllTypes(),
        ];

        return view('templates_admin/header', $data)
            . view('templates_admin/sidebar', $data)
            . view('admin/form_tambah_promo', $data)
            . view('templates_admin/footer');
    }

    public function tambah_aksi()
    {
        $rules = [
            'id_item' => 'required|numeric',
            'discount_percentage' => 'required|numeric|greater_than[0]|less_than_equal_to[100]',
            'start_date' => 'required|valid_date',
            'end_date' => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id_item' => $this->request->getPost('id_item'),
            'discount_percentage' => $this->request->getPost('discount_percentage'),
            'start_date' => $this->request->getPost('start_date'),
            'end_date' => $this->request->getPost('end_date'),
            'status' => $this->request->getPost('status')
        ];

        $this->promoModel->insert($data);
        session()->setFlashdata('pesan', 'Promo berhasil ditambahkan');
        return redirect()->to('admin/promo');
    }

    public function edit($id)
    {
        $user = $this->userModel->find(user_id());
        $promo = $this->promoModel->find($id);
        $item = $this->itemModel->find($promo['id_item']);

        $data = [
            'user' => $user,
            'promo' => $promo,
            'item' => $item
        ];

        return view('templates_admin/header', $data)
            . view('templates_admin/sidebar', $data)
            . view('admin/form_update_promo', $data)
            . view('templates_admin/footer');
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $rules = [
            'discount_percentage' => 'required|numeric|greater_than[0]|less_than_equal_to[100]',
            'start_date' => 'required|valid_date',
            'end_date' => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'discount_percentage' => $this->request->getPost('discount_percentage'),
            'start_date' => $this->request->getPost('start_date'),
            'end_date' => $this->request->getPost('end_date'),
            'status' => $this->request->getPost('status')
        ];

        $this->promoModel->update($id, $data);
        session()->setFlashdata('pesan', 'Promo berhasil diupdate');
        return redirect()->to('admin/promo');
    }

    public function delete($id)
    {
        $this->promoModel->delete($id);
        session()->setFlashdata('pesan', 'Promo berhasil dihapus');
        return redirect()->to('admin/promo');
    }
}
