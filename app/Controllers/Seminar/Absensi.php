<?php

namespace App\Controllers\Seminar;

use App\Controllers\BaseController;
use App\Models\Seminar\AbsensiModel;
use App\Models\RegistrationModel; // model pendaftaran

class Absensi extends BaseController
{
    public function index()
    {
        return view('seminar/absensi'); // path view sesuai folder views/seminar/absensi.php
    }

    public function store()
    {
        $model = new AbsensiModel();
        $registrations = new RegistrationModel();

        $nim = $this->request->getPost('nim');
        $nama = $this->request->getPost('nama');
        $sesi = $this->request->getPost('sesi');
        $foto = $this->request->getFile('foto');

        // Cek NIM di registrasi
        $cek = $registrations->where('nim', $nim)->first();
        if (!$cek) {
            return redirect()->back()->with('error', 'NIM belum terdaftar. Silakan daftar terlebih dahulu.');
        }

        // Cek apakah nama sesuai dengan NIM
        if (trim(strtolower($cek['nama'])) !== trim(strtolower($nama))) {
            return redirect()->back()->with('error', 'Nama tidak sesuai dengan NIM yang terdaftar.');
        }

        // Cek apakah peserta sudah absensi untuk sesi yang sama
        $absensiExist = $model->where('nim', $nim)->where('sesi', $sesi)->first();
        if ($absensiExist) {
            return redirect()->back()->with('error', 'Anda sudah melakukan absensi untuk sesi ini.');
        }

        // Pastikan folder uploads ada
        $uploadPath = WRITEPATH . 'uploads';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // Upload file
        if ($foto->isValid() && !$foto->hasMoved()) {
            $fotoName = $nim . '_sesi' . $sesi . '.' . $foto->getExtension();
            $foto->move($uploadPath, $fotoName);

            $model->insert([
                'nim' => $nim,
                'nama' => $nama,
                'sesi' => $sesi,
                'foto' => $fotoName
            ]);

            return redirect()->back()->with('success', 'Absensi berhasil dicatat!');
        }

        return redirect()->back()->with('error', 'Terjadi kesalahan saat upload foto.');
    }
}
