<?php

namespace App\Models\Seminar;

use CodeIgniter\Model;

class PendaftaranSettingsModel extends Model
{
    protected $table = 'seminar_pendaftaran_settings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['online', 'offline', 'updated_at'];
    protected $useTimestamps = true;
    protected $updatedField = 'updated_at';
}
