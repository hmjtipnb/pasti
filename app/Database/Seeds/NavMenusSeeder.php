<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NavMenusSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // ===== MENU TENGAH =====
            [
                'title'      => 'Program',
                'url'        => '/program',
                'position'   => 'center',
                'parent_id'  => null,
                'is_new'     => true,
                'is_active'  => true,
                'sort_order' => 1,
            ],
            [
                'title'      => 'Capaian & Dampak',
                'url'        => '/capaian-dampak',
                'position'   => 'center',
                'parent_id'  => null,
                'is_new'     => false,
                'is_active'  => true,
                'sort_order' => 2,
            ],
            [
                'title'      => 'Lainnya',
                'url'        => '#',
                'position'   => 'center',
                'parent_id'  => null,
                'is_new'     => false,
                'is_active'  => true,
                'sort_order' => 3,
            ],

            // ===== DROPDOWN (CHILD DARI "LAINNYA") =====
            [
                'title'      => 'Gus Eka (+62 832-0202-002)',
                'url'        => '/kontak',
                'position'   => 'center',
                'parent_id'  => 3, // ID "Lainnya"
                'is_new'     => false,
                'is_active'  => true,
                'sort_order' => 1,
            ],

            // ===== CTA KANAN =====
            [
                'title'      => 'Daftar Seminar',
                'url'        => '/pendaftaran',
                'position'   => 'right',
                'parent_id'  => null,
                'is_new'     => false,
                'is_active'  => true,
                'sort_order' => 1,
            ],
            [
                'title'      => 'Daftar Anggota',
                'url'        => '/pendaftaran/anggota',
                'position'   => 'right',
                'parent_id'  => null,
                'is_new'     => false,
                'is_active'  => true,
                'sort_order' => 2,
            ],
        ];

        $this->db->table('nav_menus')->insertBatch($data);
    }
}
