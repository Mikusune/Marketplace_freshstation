<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'carts';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['user_id', 'id_item', 'quantity'];
    protected $dateFormat = 'datetime';
    
    public function getCartItems($userId)
    {
        $builder = $this->db->table('carts');
        $builder->select('carts.id, carts.id_item, carts.quantity, item.nama_produk, item.harga_jual, item.gambar, promos.discount_percentage');
        $builder->join('item', 'carts.id_item = item.id_item');
        $builder->join('promos', 'item.id_item = promos.id_item AND promos.status = "active" AND promos.start_date <= CURDATE() AND promos.end_date >= CURDATE()', 'left');
        $builder->where('carts.user_id', $userId);
        return $builder->get()->getResultArray();
    }

    public function addItem($data)
    {
        $builder = $this->db->table($this->table);
        $builder->where('user_id', $data['user_id']);
        $builder->where('id_item', $data['id_item']);
        $query = $builder->get();
        
        if ($query->getNumRows() > 0) {
            // If item exists, update quantity
            $existingItem = $query->getRow();
            $newQuantity = $existingItem->quantity + $data['quantity'];
            return $this->update($existingItem->id, ['quantity' => $newQuantity]);
        } else {
            // If item doesn't exist, insert new
            return $this->insert($data);
        }
    }

    public function updateQuantity($cartId, $quantity)
    {
        return $this->update($cartId, ['quantity' => $quantity]);
    }

    public function deleteItem($cartId)
    {
        return $this->delete($cartId);
    }

    public function getCartTotal($userId)
    {
        $items = $this->getCartItems($userId);
        $total = 0;
        foreach ($items as $item) {
            $price = $item['harga_jual'];
            if (!empty($item['discount_percentage'])) {
                $price = $price - ($price * $item['discount_percentage'] / 100);
            }
            $total += $price * $item['quantity'];
        }
        return $total;
    }

    public function getCartItemCount($userId)
    {
        return $this->where('user_id', $userId)->countAllResults();
    }
}
