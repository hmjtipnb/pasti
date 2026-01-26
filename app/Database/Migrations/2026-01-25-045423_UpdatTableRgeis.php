<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateRegistrationsTable extends Migration
{
    public function up()
    {
        $fields = [
            'telp' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'after' => 'prodi',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'after' => 'telp',
            ],
            'sesi' => [
                'type' => 'ENUM',
                'constraint' => ['Offline', 'Online'],
                'after' => 'email',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'after' => 'sesi',
            ],
        ];

        $this->forge->modifyColumn('registrations', $fields);
    }

    public function down()
    {
        // optional rollback
    }
}
