<?php
namespace App\Models;

use CodeIgniter\Model;

class AddressModel extends Model
{
    protected $table = 'user_addresses';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'address', 'latitude', 'longitude', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
