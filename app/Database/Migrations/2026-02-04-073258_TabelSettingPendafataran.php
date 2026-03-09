<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSeminarPendaftaranSettings extends Migration
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
            'online' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
                'comment'    => '1 = pendaftaran online dibuka, 0 = ditutup',
            ],
            'offline' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
                'comment'    => '1 = pendaftaran offline dibuka, 0 = ditutup',
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('seminar_pendaftaran_settings');

        // Insert default row
        $this->db->table('seminar_pendaftaran_settings')->insert([
            'online'  => 1,
            'offline' => 1,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('seminar_pendaftaran_settings');
    }
}
