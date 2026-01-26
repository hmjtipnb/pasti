<?php

namespace App\Controllers;

use App\Models\ReviewModel;

class Home extends BaseController
{
    public function index()
    {
        $reviewModel = new ReviewModel();

        $data['reviews'] = $reviewModel
            ->orderBy('id', 'DESC')
            ->findAll(10); // ambil 10 ulasan terakhir

        return view('home', $data);
    }

    public function submitReview()
    {
        $reviewModel = new ReviewModel();

        $reviewModel->save([
            'name'   => $this->request->getPost('name'),
            'review' => $this->request->getPost('review'),
            'role'   => 'Mahasiswa Informatika'
        ]);

        return redirect()->back()->with('success', 'Ulasan berhasil dikirim');
    }
}
