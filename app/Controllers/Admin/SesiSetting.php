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

        // Ambil data filter & search
        $filter = $this->request->getGet('filter');
        $search = $this->request->getGet('search');

        $query = $this->usersModel->orderBy('created_at', 'DESC');

        if ($filter == 'online') {
            $query->where('sesi', 'Online');
        } elseif ($filter == 'offline') {
            $query->where('sesi', 'Offline');
        }

        if ($search) {
            $query->like('nama', $search);
        }

        // Ambil semua user peserta sesuai filter
        $users = $query->findAll();

        // Kirim data ke view
        return view('admin/peserta/index', [
            'title'        => 'Pengaturan Sesi',
            'activeMenu'   => 'peserta', // Biarkan menu peserta tetap aktif
            'users'        => $users,
            'onlineAktif'  => $onlineAktif,
            'offlineAktif' => $offlineAktif,
            'filter'       => $filter ?? '',
            'search'       => $search ?? '',
        ]);
    }

    public function toggle($sesi)
    {
        $settings = $this->settingsModel->first();

        if (!$settings) {
            // Jika belum ada, buat default
            $this->settingsModel->insert(['online' => 0, 'offline' => 0]);
            $settings = $this->settingsModel->first();
        }

        if ($sesi === 'online') {
            $newStatus = ($settings['online'] ?? 0) ? 0 : 1;
            $this->settingsModel->update($settings['id'], ['online' => $newStatus]);
        } elseif ($sesi === 'offline') {
            $newStatus = ($settings['offline'] ?? 0) ? 0 : 1;
            $this->settingsModel->update($settings['id'], ['offline' => $newStatus]);
        }

        // Redirect ke index agar view menampilkan status terbaru
        return redirect()->to(base_url('admin/peserta'))
                         ->with('success', 'Status ' . ucfirst($sesi) . ' berhasil diubah.');
    }

}
