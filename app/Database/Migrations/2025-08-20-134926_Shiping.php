<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateShippingConfigTable extends Migration
{
    public function up()
    {
        // Define fields for the shipping_config table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'price_per_km' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 5000,
            ],
        ]);

        // Add primary key
        $this->forge->addKey('id', true);

        // Create the table
        $this->forge->createTable('shipping_config', true);

        // Insert initial data. Since CI4 migrations don't have an easy way to do
        // "ON DUPLICATE KEY UPDATE" in a single command, we will insert the record
        // and handle potential errors if it already exists.
        $this->db->table('shipping_config')->insert([
            'id' => 1,
            'price_per_km' => 5000,
        ]);
    }

    public function down()
    {
        // Drop the table if the migration is rolled back
        $this->forge->dropTable('shipping_config');
    }
}