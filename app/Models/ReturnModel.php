<?php
namespace App\Models;

use CodeIgniter\Model;

class ReturnModel extends Model
{
    protected $table = 'returns';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'order_id', 'user_id', 'reason', 'photo', 'status', 'return_type', 'created_at', 'updated_at'
    ];
    protected $returnType = 'array';
}
