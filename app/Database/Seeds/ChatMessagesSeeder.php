<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ChatMessagesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id' => 2, // Sesuaikan dengan ID customer yang ada
                'message' => 'Halo, saya ingin bertanya tentang produk',
                'from_type' => 'customer',
                'created_at' => '2025-04-25 10:00:00',
                'is_read' => true
            ],
            [
                'user_id' => 2,
                'message' => 'Baik, ada yang bisa kami bantu?',
                'from_type' => 'admin',
                'created_at' => '2025-04-25 10:01:00',
                'is_read' => true
            ],
            [
                'user_id' => 2,
                'message' => 'Apakah produk sayuran masih fresh?',
                'from_type' => 'customer',
                'created_at' => '2025-04-25 10:02:00',
                'is_read' => true
            ]
        ];

        $this->db->table('chat_messages')->insertBatch($data);
    }
}