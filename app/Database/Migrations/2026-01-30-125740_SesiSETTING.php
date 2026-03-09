<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSeminarSettings extends Migration
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
            'sesi_1_aktif' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
                'comment'    => '1 = aktif, 0 = nonaktif'
            ],
            'sesi_2_aktif' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
                'comment'    => '1 = aktif, 0 = nonaktif'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('seminar_settings');
    }

    public function down()
    {
        $this->forge->dropTable('seminar_settings');
    }
}
