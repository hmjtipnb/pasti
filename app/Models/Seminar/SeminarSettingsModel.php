<?php

namespace App\Models\Seminar;

use CodeIgniter\Model;

class SeminarSettingsModel extends Model
{
    protected $table = 'seminar_settings';
    protected $allowedFields = ['sesi_1_aktif', 'sesi_2_aktif'];
}
