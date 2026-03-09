<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Seminar\PendaftaranSettingsModel;
use App\Models\Seminar\UsersModel;

class SesiSetting extends BaseController
{
    protected $settingsModel;
    protected $usersModel;

    public function __construct()
    {
        $this->settingsModel = new PendaftaranSettingsModel();
        $this->usersModel    = new UsersModel();
    }
    
    public function index()
    {
        
        // Ambil setting pendaftaran (hanya 1 row)
        $settings = $this->settingsModel->first();

        $onlineAktif  = $settings['online'] ?? 0;
        $offlineAktif = $settings['offline'] ?? 0;

        // Ambil semua user peserta
        $users = $this->usersModel->orderBy('created_at', 'DESC')->findAll();

        // Kirim data ke view
return view('admin/peserta/index', [
    'users'       => $users,
    'onlineAktif' => $onlineAktif,
    'offlineAktif'=> $offlineAktif
]);

    }

  public function toggle($sesi)
{
    $settings = $this->settingsModel->first();

    if (!$settings) {
        return redirect()->to(base_url('admin/sesi-setting'))
                         ->with('error', 'Setting tidak ditemukan.');
    }

    if ($sesi === 'online') {
        $newStatus = $settings['online'] ? 0 : 1;
        $this->settingsModel->update($settings['id'], ['online' => $newStatus]);
    } elseif ($sesi === 'offline') {
        $newStatus = $settings['offline'] ? 0 : 1;
        $this->settingsModel->update($settings['id'], ['offline' => $newStatus]);
    }

    // Redirect ke index agar view menampilkan status terbaru
    return redirect()->to(base_url('admin/sesi-setting'))
                     ->with('success', 'Status ' . ucfirst($sesi) . ' berhasil diubah.');
}

}
