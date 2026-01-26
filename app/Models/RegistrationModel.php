<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistrationModel extends Model
{
    protected $table = 'registrations';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'kode_pendaftaran',
        'nama',
        'nim',
        'kelas',
        'prodi',
        'telp',
        'email',
        'sesi',
    ];

    protected $useTimestamps = false;
}
