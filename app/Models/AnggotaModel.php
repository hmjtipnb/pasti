<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table            = 'anggota_pasti';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'kode_anggota',
        'nama',
        'nim',
        'kelas',
        'prodi',
        'telp',
        'email',
        'divisi',
        'created_at'
    ];
    protected $useTimestamps = false;
}
