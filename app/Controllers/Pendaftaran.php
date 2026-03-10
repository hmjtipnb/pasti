<?php

namespace App\Controllers;

use App\Models\RegistrationModel;
use App\Models\Seminar\PendaftaranSettingsModel;

class Pendaftaran extends BaseController
{
        protected $settingsModel;

    public function __construct()
    {
        $this->settingsModel = new PendaftaranSettingsModel();
    }
    public function index()
    {
        $regModel = new RegistrationModel();
        // Ambil status online/offline
        $settings = $this->settingsModel->first();
        $onlineAktif  = $settings['online'] ?? 0;
        $offlineAktif = $settings['offline'] ?? 0;

        // Cek jumlah kuota offline
        $offlineCount = $regModel->where('sesi', 'Offline')->countAllResults();
        $offlineFull = ($offlineCount >= 45);

        return view('seminar/index', [
            'onlineAktif'  => $onlineAktif,
            'offlineAktif' => $offlineAktif,
            'offlineFull'  => $offlineFull
        ]);
    }

    public function store()
    {
        $model = new RegistrationModel();

        $data = [
            'nama'  => $this->request->getPost('nama'),
            'nim'   => $this->request->getPost('nim'),
            'kelas' => $this->request->getPost('kelas'),
            'prodi' => $this->request->getPost('prodi'),
            'telp'  => $this->request->getPost('telp'),
            'sesi'  => $this->request->getPost('sesi'),
            'email' => $this->request->getPost('email'),
        ];

        // Safeguard for Offline limit
        if ($data['sesi'] === 'Offline') {
            $offlineCount = $model->where('sesi', 'Offline')->countAllResults();
            if ($offlineCount >= 45) {
                return redirect()->back()->with('error', 'Mohon maaf, kuota Offline sudah penuh. Silakan pilih sesi Online.');
            }
        }

        // 1️⃣ Simpan data
        $model->insert($data);
        $insertId = $model->getInsertID();

        // 2️⃣ Generate ID PASTI
        $pastiId = 'PASTI-' . str_pad($insertId, 5, '0', STR_PAD_LEFT);

        $model->update($insertId, [
            'kode_pendaftaran' => $pastiId
        ]);

        // 3️⃣ Link WhatsApp
        $waGroup = 'https://chat.whatsapp.com/ISI_LINK_GRUP';

        // 4️⃣ Kirim Email (TETAP ADA)
        $email = \Config\Services::email();
        $email->setTo($data['email']);
        $email->setSubject('Bukti Pendaftaran PASTI');
        $email->setMailType('html');

        $email->setMessage("
            <h2>Pendaftaran Berhasil 🎉</h2>
            <p>Terima kasih telah mendaftar Program Seminar <strong>PASTI</strong>.</p>
            <hr>
            <p><strong>ID Pendaftaran:</strong> {$pastiId}</p>
            <p><strong>Nama:</strong> {$data['nama']}</p>
            <p><strong>NIM:</strong> {$data['nim']}</p>
            <p><strong>Kelas:</strong> {$data['kelas']}</p>
            <p><strong>Prodi:</strong> {$data['prodi']}</p>
            <p><strong>Sesi:</strong> {$data['sesi']}</p>

            <br>
            <p><strong>📢 Informasi Penting</strong></p>
            <p>Gabung grup WhatsApp untuk info selanjutnya:</p>
            <p>
                <a href='{$waGroup}'
                   style='display:inline-block;padding:10px 20px;
                          background:#22c55e;color:#fff;
                          text-decoration:none;border-radius:20px;'>
                   Gabung Grup WhatsApp
                </a>
            </p>

            <br>
            <p>Simpan email ini sebagai bukti pendaftaran.</p>
        ");

        $email->send();

        // 5️⃣ LANGSUNG REDIRECT (TANPA FLASHDATA)
        return redirect()->to('/success');
    }

    public function success()
    {
        return view('seminar/success', [
            'title' => 'Pendaftaran Berhasil'
        ]);
    }
}
