<?php

namespace App\Models\Seminar;

use CodeIgniter\Model;

class AbsensiModel extends Model
{
    protected $table = 'absensi';
    protected $allowedFields = ['nim', 'nama', 'sesi', 'foto'];
    protected $useTimestamps = true;
}
