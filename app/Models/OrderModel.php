<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'user_id', 'order_id', 'gross_amount', 'shipping_address', 
        'courier', 'shipping_cost', 'payment_type', 
        'transaction_status', 'transaction_time', 'shipping_status'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getOrdersByUserId($userId)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    public function getOrderWithItems($orderId)
    {
        $order = $this->find($orderId);
        if ($order) {
            $orderItemModel = new OrderItemModel();
            $order->items = $orderItemModel->getItemsByOrderId($orderId);
        }
        return $order;
    }
}