<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateChatMessages extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'message' => [
                'type' => 'TEXT',
            ],
            'from_type' => [
                'type' => 'ENUM',
                'constraint' => ['customer', 'admin'],
                'default' => 'customer',
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'is_read' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('chat_messages');
    }

    public function down()
    {
        $this->forge->dropTable('chat_messages');
    }
}