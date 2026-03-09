<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RegistrationModel;
use App\Models\Seminar\AbsensiModel;
use App\Models\Seminar\SeminarSettingsModel;

class Users extends BaseController
{
    protected $registrationModel;
    protected $absensiModel;
    protected $settingsModel;

    public function __construct()
    {
        $this->registrationModel = new RegistrationModel();
        $this->absensiModel     = new AbsensiModel();
        $this->settingsModel    = new SeminarSettingsModel();
    }

    // =========================
    // DAFTAR PESERTA
    // =========================
    public function index()
    {
        if (!session()->get('admin_logged_in')) {
            return redirect()->to(base_url('admin/login'));
        }

        $data = [
            'title'      => 'Daftar Peserta',
            'users'      => $this->registrationModel
                                    ->orderBy('created_at', 'DESC')
                                    ->findAll(),
            'activeMenu' => 'peserta'
        ];

        return view('admin/peserta/index', $data);
    }

    // =========================
    // HALAMAN ABSENSI ADMIN
    // =========================
    public function absensi()
    {
        if (!session()->get('admin_logged_in')) {
            return redirect()->to(base_url('admin/login'));
        }

        // Ambil pengaturan sesi (anggap hanya 1 row)
        $settings = $this->settingsModel->first();

        // Jika belum ada data setting, buat default
        if (!$settings) {
            $this->settingsModel->insert([
                'sesi_1_aktif' => 0,
                'sesi_2_aktif' => 0,
            ]);
            $settings = $this->settingsModel->first();
        }

        $data = [
            'title'        => 'Daftar Absensi',
            'absensi'      => $this->absensiModel
                                    ->orderBy('created_at', 'DESC')
                                    ->findAll(),
            'activeMenu'   => 'absensi',
            'sesi1Aktif'   => $settings['sesi_1_aktif'],
            'sesi2Aktif'   => $settings['sesi_2_aktif'],
        ];

        return view('admin/peserta/absensi', $data);
    }

    // =========================
    // TOGGLE SESI
    // =========================
    public function toggleSesi($sesi)
    {
        if (!session()->get('admin_logged_in')) {
            return redirect()->to(base_url('admin/login'));
        }

        $settings = $this->settingsModel->first();

        if (!$settings) {
            return redirect()->back()->with('error', 'Pengaturan sesi belum tersedia.');
        }

        if ($sesi == 1) {
            $this->settingsModel->update($settings['id'], [
                'sesi_1_aktif' => $settings['sesi_1_aktif'] ? 0 : 1
            ]);
        } elseif ($sesi == 2) {
            $this->settingsModel->update($settings['id'], [
                'sesi_2_aktif' => $settings['sesi_2_aktif'] ? 0 : 1
            ]);
        }

        return redirect()->back()->with('success', "Status Sesi {$sesi} berhasil diperbarui");
    }
}