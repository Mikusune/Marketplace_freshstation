<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePromosTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_item' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'discount_percentage' => [
                'type'       => 'INT',
                'constraint' => 3,
                'null'      => false,
            ],
            'start_date' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'end_date' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'inactive'],
                'default'    => 'active',
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
        $this->forge->addForeignKey('id_item', 'item', 'id_item', 'CASCADE', 'CASCADE');
        $this->forge->createTable('promos');
    }

    public function down()
    {
        $this->forge->dropTable('promos');
    }
}
