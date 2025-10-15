<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Myth\Auth\Models\UserModel;

class ProductController extends BaseController
{
    protected $itemModel;
    protected $db;
    protected $userModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->itemModel = new \App\Models\ItemModel();
        $this->userModel = new UserModel();
    }

    public function search()
    {
        $user = null;
        if (user_id()) {
            $user = $this->userModel->find(user_id());
        }

        $keyword = $this->request->getGet('keyword');
        $type = $this->request->getGet('type');
        
        // Get categories with product counts
        $categories = $this->db->query("
            SELECT 
                type.kode_type, 
                type.nama_type, 
                type.img,
                COUNT(item.id_item) as jumlah 
            FROM type 
            LEFT JOIN item ON type.kode_type = item.kode_type 
            GROUP BY type.kode_type, type.nama_type, type.img
            ORDER BY jumlah DESC"
        )->getResultArray();
        
        // Get filtered items
        $query = $this->itemModel->select('item.*, type.nama_type, promos.discount_percentage')
            ->join('type', 'type.kode_type = item.kode_type')
            ->join('promos', 'item.id_item = promos.id_item AND promos.status = "active" AND promos.start_date <= CURDATE() AND promos.end_date >= CURDATE()', 'left');
            
        if ($keyword) {
            $query->groupStart()
                  ->like('item.nama_produk', $keyword)
                  ->orLike('item.deskripsi', $keyword)
                  ->orLike('type.nama_type', $keyword)
                  ->groupEnd();
        }
        
        if ($type) {
            $query->where('item.kode_type', $type);
        }
        
        $data = [
            'items' => $query->findAll(),
            'keyword' => $keyword,
            'selected_type' => $type,
            'categories' => $categories,
            'user' => $user
        ];
        
        return view('templates_customer/header', ['user' => $user])
            . view('products/search', $data)
            . view('templates_customer/footer');
    }
}