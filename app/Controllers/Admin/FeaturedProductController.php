<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use Myth\Auth\Models\UserModel;

class FeaturedProductController extends BaseController
{
    protected $itemModel;
    protected $userModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $user = null;
        if (user_id()) {
            $user = $this->userModel->find(user_id());
        }

        // Get all products with their categories
        $products = $this->itemModel->select('item.*, type.nama_type')
                                  ->join('type', 'type.kode_type = item.kode_type')
                                  ->findAll();

        $data = [
            'user' => $user,
            'products' => $products
        ];

        return view('templates_admin/header', ['user' => $user])
            . view('templates_admin/sidebar')
            . view('admin/featured_products', $data)
            . view('templates_admin/footer');
    }

    public function toggle($id)
    {
        $item = $this->itemModel->find($id);
        if (!$item) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Product not found'
            ]);
        }

        $newStatus = $item['is_featured'] ? 0 : 1;
        $this->itemModel->update($id, ['is_featured' => $newStatus]);

        return $this->response->setJSON([
            'success' => true,
            'featured' => $newStatus == 1,
            'message' => 'Product ' . ($newStatus == 1 ? 'set as featured' : 'removed from featured') . ' successfully'
        ]);
    }
}