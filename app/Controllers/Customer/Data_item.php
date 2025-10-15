<?php

namespace App\Controllers\Customer;

use App\Models\ItemModel;
use CodeIgniter\Controller;
use Myth\Auth\Models\UserModel;

class Data_item extends Controller
{
    protected $itemModel;
    protected $userModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->userModel = new UserModel();
    }

    public function index($selectedType = null)
    {   
        $user = null;
        if (user_id()) {
            $user = $this->userModel->find(user_id());
        }

        $perPage = 8;

        if ($selectedType) {
            $items = $this->itemModel->getItemByType($selectedType, $perPage);
        } else {
            $items = $this->itemModel->getPaginateditem($perPage);
        }

        // Calculate discounted prices for items with active promos
        foreach ($items as &$item) {
            if (isset($item['discount_percentage']) && $item['discount_percentage'] > 0) {
                $item['discounted_price'] = $this->itemModel->calculateDiscountedPrice($item);
            }
        }

        $data = [
            'items' => $items,
            'types' => $this->itemModel->getAllTypesWithCount(),
            'selectedType' => $selectedType,
            'pager' => $this->itemModel->pager
        ];
        
        return view('templates_customer/header', ['user' => $user])
            . view('customer/data_item', $data)
            . view('templates_customer/footer');
    }

    public function detail_item($id)
    {
        $user = null;
        if (user_id()) {
            $user = $this->userModel->find(user_id());
        }

        // Get item details
        $item = $this->itemModel->ambilIditem($id);
        
        if (!$item) {
            return redirect()->to('/products');
        }

        // Get suggested items with pagination (4 items per page)
        $suggested_items = $this->itemModel->getSuggestedItems($item['kode_type'], $id, 4);

        // Calculate discounted prices for suggested items
        foreach ($suggested_items as &$suggested_item) {
            if (isset($suggested_item['discount_percentage']) && $suggested_item['discount_percentage'] > 0) {
                $suggested_item['discounted_price'] = $this->itemModel->calculateDiscountedPrice($suggested_item);
            }
        }

        $data = [
            'item' => $item,
            'suggested_items' => $suggested_items,
            'pager' => $this->itemModel->pager,
            'user' => $user
        ];
        
        return view('templates_customer/header', ['user' => $user])
            . view('customer/detail_item', $data)
            . view('templates_customer/footer');
    }
}
