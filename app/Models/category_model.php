<?php
namespace App\Models;

use CodeIgniter\Model;

class category_model extends Model
{
    protected $table = 'type'; // Ganti dengan nama tabel Anda
    protected $primaryKey = 'id_type'; // Ganti dengan primary key tabel Anda
    protected $allowedFields = ['nama_type', 'img']; // Ganti dengan field yang sesuai
}