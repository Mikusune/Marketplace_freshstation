<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table = 'item';
    protected $primaryKey = 'id_item';
    protected $allowedFields = [
        'nama_produk', 
        'kode_type',
        'brand',
        'berat', 
        'status',
        'harga_beli',
        'harga_jual',
        'gambar',
        'deskripsi',
        'is_featured',
        'stok'
    ];

    protected $returnType = 'array';

    public function getPaginateditem($perPage)
    {
        return $this->select('item.*, type.nama_type, promos.discount_percentage, promos.end_date as promo_end_date') 
                    ->join('type', 'item.kode_type = type.kode_type', 'left')
                    ->join('promos', 'item.id_item = promos.id_item AND promos.status = "active" AND promos.start_date <= CURDATE() AND promos.end_date >= CURDATE()', 'left')
                    ->orderBy('item.id_item', 'DESC')
                    ->asArray()
                    ->paginate($perPage, 'default');
    }

    public function getitemByType($kode_type, $perPage)
    {
        return $this->select('item.*, type.nama_type, promos.discount_percentage, promos.end_date as promo_end_date')
                    ->join('type', 'item.kode_type = type.kode_type', 'left')
                    ->join('promos', 'item.id_item = promos.id_item AND promos.status = "active" AND promos.start_date <= CURDATE() AND promos.end_date >= CURDATE()', 'left')
                    ->where('item.kode_type', $kode_type)
                    ->asArray()
                    ->paginate($perPage, 'items');
    }

    public function getAllTypes()
    {
        return $this->db->table('type')->get()->getResultArray();
    }

    public function getAllTypesWithCount()
    {
        return $this->db->query("
            SELECT 
                type.kode_type, 
                type.nama_type, 
                type.img,
                COUNT(item.id_item) as jumlah 
            FROM type 
            LEFT JOIN item ON type.kode_type = item.kode_type 
            GROUP BY type.kode_type, type.nama_type, type.img
            ORDER BY jumlah DESC
        ")->getResultArray();
    }

    public function insertitem($data)
    {
        return $this->insert($data);
    }

    public function ambilIditem($id)
    {
        $builder = $this->db->table('item');
        $builder->select('item.*, type.nama_type, promos.discount_percentage, promos.end_date as promo_end_date');
        $builder->join('type', 'item.kode_type = type.kode_type', 'left');
        $builder->join('promos', 'item.id_item = promos.id_item AND promos.status = "active" AND promos.start_date <= CURDATE() AND promos.end_date >= CURDATE()', 'left');
        $builder->where('item.id_item', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function getSuggestedItems($kode_type, $current_id, $perPage = 8)
    {
        return $this->select('item.*, type.nama_type, promos.discount_percentage, promos.end_date as promo_end_date')
                    ->join('type', 'item.kode_type = type.kode_type', 'left')
                    ->join('promos', 'item.id_item = promos.id_item AND promos.status = "active" AND promos.start_date <= CURDATE() AND promos.end_date >= CURDATE()', 'left')
                    ->where([
                        'item.kode_type' => $kode_type,
                        'item.id_item !=' => $current_id,
                        'item.status' => '1'
                    ])
                    ->orderBy('RAND()')
                    ->paginate($perPage, 'suggested_items');
    }

    public function getItems($type = null, $sort = null)
    {
        $builder = $this->db->table('item');
        $builder->select('item.*, type.nama_type, promos.discount_percentage, promos.end_date as promo_end_date,
                         (item.harga_jual * (1 - IFNULL(promos.discount_percentage, 0) / 100)) as discounted_price');
        $builder->join('type', 'item.kode_type = type.kode_type');
        $builder->join('promos', 'item.id_item = promos.id_item AND promos.status = "active" AND promos.start_date <= CURDATE() AND promos.end_date >= CURDATE()', 'left');

        if ($type) {
            $builder->where('item.kode_type', $type);
        }

        if ($sort) {
            $builder = $this->applySort($builder, $sort);
        } else {
            $builder->orderBy('item.id_item', 'DESC');
        }

        return $builder->get()->getResultArray();
    }

    public function getItemById($id)
    {
        $builder = $this->db->table('item');
        $builder->select('item.*, type.nama_type, promos.discount_percentage, promos.end_date as promo_end_date');
        $builder->join('type', 'item.kode_type = type.kode_type');
        $builder->join('promos', 'item.id_item = promos.id_item AND promos.status = "active" AND promos.start_date <= CURDATE() AND promos.end_date >= CURDATE()', 'left');
        $builder->where('item.id_item', $id);
        return $builder->get()->getRowArray();
    }

    public function calculateDiscountedPrice($item)
    {
        if (isset($item['discount_percentage']) && $item['discount_percentage'] > 0) {
            return $item['harga_jual'] - ($item['harga_jual'] * $item['discount_percentage'] / 100);
        }
        return $item['harga_jual'];
    }

    public function getFeaturedItems($limit = null)
    {
        $query = $this->select('item.*, type.nama_type, promos.discount_percentage')
                     ->join('type', 'item.kode_type = type.kode_type', 'left')
                     ->join('promos', 'item.id_item = promos.id_item AND promos.status = "active" AND promos.start_date <= CURDATE() AND promos.end_date >= CURDATE()', 'left')
                     ->where('item.is_featured', 1)
                     ->orderBy('item.id_item', 'DESC');
        
        if ($limit) {
            $query->limit($limit);
        }
        
        return $query->find();
    }

    public function toggleFeatured($id, $status)
    {
        return $this->update($id, ['is_featured' => $status]);
    }

    public function getFeaturedProducts($limit = null)
    {
        $builder = $this->select('item.*, type.nama_type')
                       ->join('type', 'type.kode_type = item.kode_type')
                       ->where('item.is_featured', 1)
                       ->where('item.status', 1);
                       
        if ($limit) {
            $builder->limit($limit);
        }
        
        return $builder->find();
    }

    protected function applySort($builder, $sort) {
        switch ($sort) {
            case 'price_asc':
                $builder->orderBy('discounted_price', 'ASC')
                        ->orderBy('item.harga_jual', 'ASC');
                break;
            case 'price_desc':
                $builder->orderBy('discounted_price', 'DESC')
                        ->orderBy('item.harga_jual', 'DESC');
                break;
            case 'name_asc':
                $builder->orderBy('item.nama_produk', 'ASC');
                break;
            case 'name_desc':
                $builder->orderBy('item.nama_produk', 'DESC');
                break;
            default:
                $builder->orderBy('item.id_item', 'DESC');
        }
        return $builder;
    }
}
