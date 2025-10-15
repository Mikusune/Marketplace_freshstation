<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrdersTable extends Migration
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
            'order_id' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'gross_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'shipping_address' => [
                'type' => 'TEXT',
            ],
            'courier' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'shipping_cost' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'payment_type' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'transaction_status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'default' => 'pending',
            ],
            'transaction_time' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}