<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNavbarTable extends Migration
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
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'url' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'position' => [
                'type'       => 'ENUM',
                'constraint' => ['center', 'right'],
                'default'    => 'center',
            ],
            'parent_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'is_new' => [
                'type'       => 'TINYINT',
                'default'    => 0,
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'default'    => 1,
            ],
            'sort_order' => [
                'type'       => 'INT',
                'default'    => 1,
            ],
            'created_at DATETIME null',
            'updated_at DATETIME null',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('navbar');
    }

    public function down()
    {
        // 🔥 INI YANG HAPUS TABEL
        $this->forge->dropTable('navbar', true);
    }
}
