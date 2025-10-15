<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use App\Models\category_model;
use Config\Database;
use Myth\Auth\Models\UserModel;


class TypeController extends BaseController
{
    protected $itemModel;
    protected $db;
    protected $userModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->db = Database::connect();
        $this->userModel = new UserModel();
        $this->categoryModel = new category_model();
    }

    public function index()
    {   
        $user = null;
        if (user_id()) {  // user_id() adalah fungsi global dari Myth\Auth untuk mendapatkan user_id
            $user = $this->userModel->find(user_id()); // Ambil data user berdasarkan user_id
        }

        $data['type'] = $this->itemModel->getAllTypes();
        
        return view('templates_admin/header',['user' => $user])
            . view('templates_admin/sidebar')
            . view('admin/Data_type', $data)
            . view('templates_admin/footer');
    }

    public function tambah_type()
    {   
        $user = null;
        if (user_id()) {  // user_id() adalah fungsi global dari Myth\Auth untuk mendapatkan user_id
            $user = $this->userModel->find(user_id()); // Ambil data user berdasarkan user_id
        }
        return view('templates_admin/header',['user' => $user])
            . view('templates_admin/sidebar')
            . view('admin/form_tambah_type')
            . view('templates_admin/footer');
    }

    public function simpan_type()
    {
        $file = $this->request->getFile('gambar');
        $fileName = '';

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('assets/uploads', $fileName);
        }

        $data = [
            'kode_type' => $this->request->getPost('kode_type'),
            'nama_type' => $this->request->getPost('nama_type'),
            'img' => $fileName // Menggunakan nama kolom 'img' sesuai dengan database
        ];

        $this->db->table('type')->insert($data);
        session()->setFlashdata('pesan', 'Kategori berhasil ditambahkan');
        return redirect()->to('admin/data_type');
    }

    public function update_type($id)
    {   
        $user = null;
        if (user_id()) {  // user_id() adalah fungsi global dari Myth\Auth untuk mendapatkan user_id
            $user = $this->userModel->find(user_id()); // Ambil data user berdasarkan user_id
        }
        $data['type'] = $this->db->table('type')->where('id_type', $id)->get()->getResultArray();
        
        return view('templates_admin/header',['user' => $user])
            . view('templates_admin/sidebar')
            . view('admin/form_update_type', $data)
            . view('templates_admin/footer');
    }

    public function update_type_aksi()
    {
        $id = $this->request->getPost('id_type');
        $data = [
            'kode_type' => $this->request->getPost('kode_type'),
            'nama_type' => $this->request->getPost('nama_type')
        ];

        $this->db->table('type')->where('id_type', $id)->update($data);
        session()->setFlashdata('pesan', 'Kategori berhasil diupdate');
        return redirect()->to('admin/data_type');
    }

    public function delete_type($id)
    {
        $this->db->table('type')->where('id_type', $id)->delete();
        session()->setFlashdata('pesan', 'Kategori berhasil dihapus');
        return redirect()->to('admin/data_type');
    }
}
