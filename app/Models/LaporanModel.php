<?php
namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    public function getLaporanPenjualan($tanggal_mulai, $tanggal_akhir)
    {
        $builder = $this->db->table('order_items')
            ->select('orders.created_at, item.nama_produk, order_items.quantity, order_items.price,
                item.harga_beli,
                (order_items.quantity * order_items.price) as subtotal_penjualan,
                (order_items.quantity * item.harga_beli) as subtotal_modal,
                ((order_items.quantity * order_items.price) - (order_items.quantity * item.harga_beli)) as keuntungan')
            ->join('orders', 'orders.id = order_items.order_id')
            ->join('item', 'item.id_item = order_items.item_id')
            ->where('orders.created_at >=', $tanggal_mulai)
            ->where('orders.created_at <=', $tanggal_akhir)
            ->orderBy('orders.created_at', 'ASC');
        return $builder->get()->getResultArray();
    }
}
