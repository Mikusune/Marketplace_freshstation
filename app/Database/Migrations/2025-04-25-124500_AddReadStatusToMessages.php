<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddReadStatusToMessages extends Migration
{
    public function up()
    {
        $this->forge->addColumn('chat_messages', [
            'is_read' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('chat_messages', 'is_read');
    }
}