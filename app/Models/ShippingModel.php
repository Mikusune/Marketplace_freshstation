<?php
namespace App\Models;

use CodeIgniter\Model;

class ShippingModel extends Model
{
    protected $table = 'shipping_config';
    protected $primaryKey = 'id';
    protected $allowedFields = ['price_per_km'];
    public $timestamps = false;
}
