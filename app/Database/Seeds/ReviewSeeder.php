<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Andi Pratama',
                'role' => 'Mahasiswa Informatika',
                'review' => 'Program PASTI sangat membantu saya meningkatkan prestasi akademik dan kepercayaan diri.',
            ],
            [
                'name' => 'Siti Aulia',
                'role' => 'Mahasiswa Informatika',
                'review' => 'Materi pelatihan di PASTI relevan dengan kebutuhan industri dan mudah dipahami.',
            ],
            [
                'name' => 'Rizky Mahendra',
                'role' => 'Mahasiswa Informatika',
                'review' => 'PASTI membuka banyak peluang dan relasi yang sangat bermanfaat untuk masa depan karier.',
            ],
            [
                'name' => 'Dewi Lestari',
                'role' => 'Mahasiswa Informatika',
                'review' => 'Saya jadi lebih terarah dalam mengembangkan skill dan menentukan tujuan karier.',
            ],
            [
                'name' => 'Bagus Santoso',
                'role' => 'Mahasiswa Informatika',
                'review' => 'Pelatihannya praktis, mentornya berpengalaman, dan sangat aplikatif.',
            ],
            [
                'name' => 'Fajar Nugroho',
                'role' => 'Mahasiswa Informatika',
                'review' => 'Networking dari PASTI benar-benar terasa dampaknya sampai sekarang.',
            ],
        ];

        $this->db->table('reviews')->insertBatch($data);
    }
}
