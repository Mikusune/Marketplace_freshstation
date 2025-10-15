<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPricesToItemTable extends Migration
{
    public function up()
    {
        // 1. Rename the 'harga' column to 'harga_jual'
        $this->forge->modifyColumn('item', [
            'harga' => [
                'name'       => 'harga_jual',
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => false,
                'default'    => 0,
            ],
        ]);

        // 2. Add the 'harga_beli' column after 'deskripsi'
        $fields = [
            'harga_beli' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => false,
                'default'    => 0,
                'after'      => 'deskripsi',
            ],
        ];
        
        $this->forge->addColumn('item', $fields);
    }

    public function down()
    {
        // 1. Drop the 'harga_beli' column
        $this->forge->dropColumn('item', 'harga_beli');
        
        // 2. Rename the 'harga_jual' column back to 'harga'
        $this->forge->modifyColumn('item', [
            'harga_jual' => [
                'name'       => 'harga',
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => false,
                'default'    => 0,
            ],
        ]);
    }
}
