<?php

namespace App\Models\Seminar;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table      = 'registrations'; // sesuaikan dengan nama table
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'kode_pendaftaran', 'nama', 'nim', 'kelas', 'prodi',
        'telp', 'email', 'sesi', 'created_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
}
