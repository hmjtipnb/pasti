<?php

namespace App\Controllers;

use App\Models\ReviewModel;

class ReviewController extends BaseController
{
public function store()
{
    $reviewModel = new ReviewModel();

    $ip = $this->request->getIPAddress();
    $today = date('Y-m-d');

    // Cek apakah IP ini sudah kirim ulasan hari ini
    $exists = $reviewModel
        ->where('ip_address', $ip)
        ->where('DATE(created_at)', $today)
        ->first();

    if ($exists) {
        return redirect()->back()->with(
            'error',
            'Anda sudah mengirim ulasan hari ini. Silakan coba besok.'
        );
    }

    $reviewModel->insert([
        'name'       => $this->request->getPost('name'),
        'review'     => $this->request->getPost('content'),
        'role'       => 'Mahasiswa Informatika',
        'ip_address' => $ip,
        'created_at' => date('Y-m-d H:i:s'),
    ]);

    return redirect()->back()->with('success', 'Ulasan berhasil dikirim!');
}

}
