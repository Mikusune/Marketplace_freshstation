<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemModel extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['order_id', 'item_id', 'quantity', 'price'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getItemsByOrderId($orderId)
    {
        return $this->select('order_items.*, item.nama_produk, item.gambar')
                    ->join('item', 'item.id_item = order_items.item_id')
                    ->where('order_items.order_id', $orderId)
                    ->findAll();
    }
}