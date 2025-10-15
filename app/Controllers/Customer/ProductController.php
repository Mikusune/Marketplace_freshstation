<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use App\Models\PromoModel;

class ProductController extends BaseController
{
    protected $itemModel;
    protected $promoModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->promoModel = new PromoModel();
    }

    public function index()
    {
        $category = $this->request->getGet('type');
        $sort = $this->request->getGet('sort') ?? 'default';
        $perPage = 12;

        // Get all types with count
        $types = $this->itemModel->getAllTypesWithCount();

        // Base query with promo information
        $query = $this->itemModel->select('item.*, type.nama_type, promos.discount_percentage, promos.end_date as promo_end_date, 
                    (item.harga_jual * (1 - IFNULL(promos.discount_percentage, 0) / 100)) as discounted_price')
                                ->join('type', 'item.kode_type = type.kode_type', 'left')
                                ->join('promos', 'item.id_item = promos.id_item AND promos.status = "active" AND promos.start_date <= CURDATE() AND promos.end_date >= CURDATE()', 'left');

        // Apply category filter
        if ($category) {
            $query->where('item.kode_type', $category);
        }

        // Apply sorting with discount consideration
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('discounted_price', 'ASC')
                      ->orderBy('item.harga_jual', 'ASC');
                break;
            case 'price_desc':
                $query->orderBy('discounted_price', 'DESC')
                      ->orderBy('item.harga_jual', 'DESC');
                break;
            case 'name_asc':
                $query->orderBy('item.nama_produk', 'ASC');
                break;
            case 'name_desc':
                $query->orderBy('item.nama_produk', 'DESC');
                break;
            default:
                $query->orderBy('item.id_item', 'DESC');
        }

        // Get paginated items
        $items = $query->paginate($perPage, 'default');

        // Calculate discounted prices
        foreach ($items as &$item) {
            if (isset($item['discount_percentage']) && $item['discount_percentage'] > 0) {
                $item['discounted_price'] = $this->itemModel->calculateDiscountedPrice($item);
            }
        }

        $data = [
            'items' => $items,
            'types' => $types,
            'pager' => $this->itemModel->pager,
            'currentType' => $category,
            'currentSort' => $sort
        ];

        return view('templates_customer/header', $data)
            . view('customer/products', $data)
            . view('templates_customer/footer');
    }

    public function detail($id)
    {
        $item = $this->itemModel->getItemById($id);
        
        if (!$item) {
            return redirect()->to('/products')->with('error', 'Product not found');
        }

        if (isset($item['discount_percentage']) && $item['discount_percentage'] > 0) {
            $item['discounted_price'] = $this->itemModel->calculateDiscountedPrice($item);
        }

        // Get suggested items
        $suggestedItems = $this->itemModel->getSuggestedItems($item['kode_type'], $id);
        foreach ($suggestedItems as &$suggestedItem) {
            if (isset($suggestedItem['discount_percentage']) && $suggestedItem['discount_percentage'] > 0) {
                $suggestedItem['discounted_price'] = $this->itemModel->calculateDiscountedPrice($suggestedItem);
            }
        }

        $data = [
            'item' => $item,
            'suggestedItems' => $suggestedItems
        ];

        return view('templates_customer/header', $data)
            . view('customer/detail_item', $data)
            . view('templates_customer/footer');
    }
}
