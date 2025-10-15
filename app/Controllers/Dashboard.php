<?php

namespace App\Controllers;

use App\Models\ItemModel;
use App\Models\PromoModel;
use Myth\Auth\Models\UserModel;

class Dashboard extends BaseController
{
    protected $itemModel;
    protected $userModel;
    protected $promoModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->userModel = new UserModel();
        $this->promoModel = new PromoModel();
    }

    public function index()
    {
        $user = null;
        if (user_id()) {
            $user = $this->userModel->find(user_id());
        }

        // Get featured products
        $items = $this->itemModel->select('item.*, type.nama_type, promos.discount_percentage, item.stok')
                                ->join('type', 'item.kode_type = type.kode_type', 'left')
                                ->join('promos', 'item.id_item = promos.id_item AND promos.status = "active" AND promos.start_date <= CURDATE() AND promos.end_date >= CURDATE()', 'left')
                                ->where('item.is_featured', 1)
                                ->orderBy('id_item', 'DESC')
                                ->find();

        // Get categories with images
        $categories = $this->itemModel->getAllTypesWithCount();

        // Get active promos with stock information
        $promos = $this->promoModel->getActivePromos();

        $data = [
            'user' => $user,
            'item' => $items,
            'categories' => $categories,
            'promos' => $promos
        ];

        return view('templates_customer/header', ['user' => $user])
            . view('customer/dashboard', $data)
            . view('templates_customer/footer');
    }
}
