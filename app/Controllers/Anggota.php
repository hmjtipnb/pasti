<?php

namespace App\Controllers;

use App\Models\AnggotaModel;

class Anggota extends BaseController
{
    protected $anggotaModel;

    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
    }

    // FORM PENDAFTARAN
    public function index()
    {
        return view('anggota/daftar');
    }

    // SIMPAN DATA + EMAIL
    public function store()
    {
        // 1️⃣ VALIDASI
        if (! $this->validate([
            'nama'   => 'required|min_length[3]',
            'nim'    => 'required',
            'kelas'  => 'required',
            'prodi'  => 'required',
            'telp'   => 'required',
            'email'  => 'required|valid_email',
            'divisi' => 'required',
        ])) {
            return redirect()->back()->withInput();
        }

        // 2️⃣ SIMPAN DATA
        $data = [
            'nama'       => $this->request->getPost('nama'),
            'nim'        => $this->request->getPost('nim'),
            'kelas'      => $this->request->getPost('kelas'),
            'prodi'      => $this->request->getPost('prodi'),
            'telp'       => $this->request->getPost('telp'),
            'email'      => $this->request->getPost('email'),
            'divisi'     => $this->request->getPost('divisi'),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // insert() returns the primary key ID if it's auto-incrementing
        $insertId = $this->anggotaModel->insert($data);

        if (!$insertId) {
            // Jika gagal insert, return error
            return redirect()->back()->with('error', 'Gagal memproses pendaftaran. Silakan coba lagi.');
        }

        // 3️⃣ GENERATE KODE ANGGOTA
        $kodeAnggota = 'PASTI-A-' . str_pad($insertId, 5, '0', STR_PAD_LEFT);

        $this->anggotaModel->update($insertId, [
            'kode_anggota' => $kodeAnggota
        ]);

        // 4️⃣ KIRIM EMAIL
        $this->_sendEmail($data, $kodeAnggota);

        // 5️⃣ REDIRECT KE SUCCESS PAGE
        return redirect()->to('/pendaftaran/anggota/success');
    }

    // HALAMAN SUKSES
    public function success()
    {
        return view('anggota/success', [
            'title' => 'Pendaftaran Anggota Berhasil'
        ]);
    }

    // ======================
    // EMAIL FUNCTION
    // ======================
    private function _sendEmail($data, $kodeAnggota)
    {
        $waGroup = 'https://chat.whatsapp.com/ISI_LINK_GRUP_ANGGOTA';

        $email = \Config\Services::email();
        $email->setTo($data['email']);
        $email->setSubject('Pendaftaran Anggota Aktif PASTI');
        $email->setMailType('html');

        $email->setMessage("
            <h2>🎉 Pendaftaran Berhasil</h2>
            <p>Terima kasih telah mendaftar sebagai <strong>Anggota Aktif PASTI</strong>.</p>
            <hr>
            <p><strong>Kode Anggota:</strong> {$kodeAnggota}</p>
            <p><strong>Nama:</strong> {$data['nama']}</p>
            <p><strong>NIM:</strong> {$data['nim']}</p>
            <p><strong>Divisi:</strong> {$data['divisi']}</p>

            <br>
            <p><strong>📢 Langkah Selanjutnya</strong></p>
            <p>Silakan bergabung ke grup WhatsApp anggota aktif:</p>
            <p>
                <a href='{$waGroup}'
                   style='display:inline-block;
                          padding:10px 20px;
                          background:#0D87B0;
                          color:#fff;
                          text-decoration:none;
                          border-radius:20px;'>
                    Gabung Grup WhatsApp
                </a>
            </p>

            <br>
            <p>Simpan email ini sebagai bukti pendaftaran.</p>
        ");

        $email->send();
    }
}
