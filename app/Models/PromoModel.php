<?php

namespace App\Models;

use CodeIgniter\Model;

class PromoModel extends Model
{
    protected $table = 'promos';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_item',
        'discount_percentage',
        'start_date',
        'end_date',
        'status'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Get active promos with item details
    public function getActivePromos()
    {
        $currentDate = date('Y-m-d');
        return $this->db->table('promos')
            ->select('promos.*, item.nama_produk, item.gambar, item.harga_jual as original_price, item.stok, type.nama_type')
            ->join('item', 'promos.id_item = item.id_item')
            ->join('type', 'item.kode_type = type.kode_type')
            ->where('promos.status', 'active')
            ->where('promos.start_date <=', $currentDate)
            ->where('promos.end_date >=', $currentDate)
            ->orderBy('discount_percentage', 'DESC')
            ->get()
            ->getResultArray();
    }

    // Get all promos with item details for admin
    public function getAllPromos()
    {
        return $this->select('promos.*, item.nama_produk, item.harga_jual as original_price, item.gambar, type.nama_type')
                    ->join('item', 'promos.id_item = item.id_item')
                    ->join('type', 'item.kode_type = type.kode_type')
                    ->orderBy('promos.created_at', 'DESC')
                    ->findAll();
    }

    // Calculate discounted price
    public function calculateDiscountedPrice($originalPrice, $discountPercentage)
    {
        $discount = ($originalPrice * $discountPercentage) / 100;
        return $originalPrice - $discount;
    }

    // Get items that don't have active promos
    public function getAvailableItems()
    {
        // Get IDs of items that already have active promos
        $activePromoItems = $this->select('id_item')
                                ->where('status', 'active')
                                ->where('start_date <=', date('Y-m-d'))
                                ->where('end_date >=', date('Y-m-d'))
                                ->findAll();
        
        // Extract just the id_item values into an array
        $activeItemIds = array_column($activePromoItems, 'id_item');
        
        // If no active promos, return all items
        if (empty($activeItemIds)) {
            return $this->db->table('item')
                           ->select('item.*, type.nama_type')
                           ->join('type', 'item.kode_type = type.kode_type')
                           ->get()
                           ->getResultArray();
        }

        // Get items that don't have active promos
        return $this->db->table('item')
                       ->select('item.*, type.nama_type')
                       ->join('type', 'item.kode_type = type.kode_type')
                       ->whereNotIn('id_item', $activeItemIds)
                       ->get()
                       ->getResultArray();
    }
}
