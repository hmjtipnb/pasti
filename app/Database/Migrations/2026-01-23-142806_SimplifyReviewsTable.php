<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SimplifyReviewsTable extends Migration
{
    public function up()
    {
        // Ubah kolom content → review
        $this->forge->modifyColumn('reviews', [
            'content' => [
                'name' => 'review',
                'type' => 'TEXT',
            ],
        ]);

        // Set default role
        $this->forge->modifyColumn('reviews', [
            'role' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => 'Mahasiswa Informatika',
            ],
        ]);

        // Hapus kolom yang tidak dipakai
        $this->forge->dropColumn('reviews', ['photo', 'rating', 'is_active', 'updated_at']);
    }

    public function down()
    {
        // Kembalikan kolom
        $this->forge->addColumn('reviews', [
            'photo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'rating' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 5,
            ],
            'is_active' => [
                'type'    => 'BOOLEAN',
                'default' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        // Balikin review → content
        $this->forge->modifyColumn('reviews', [
            'review' => [
                'name' => 'content',
                'type' => 'TEXT',
            ],
        ]);
    }
}
