<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateAnggotaPastiTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('anggota_pasti', [
            'kode_anggota' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'after'      => 'id',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('anggota_pasti', 'kode_anggota');
    }
}
