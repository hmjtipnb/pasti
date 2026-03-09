<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ReviewModel;

class ReviewController extends BaseController
{
    protected $reviewModel;

    public function __construct()
    {
        $this->reviewModel = new ReviewModel();
    }

    // 📌 LIST REVIEW
    public function index()
    {
        $data['reviews'] = $this->reviewModel
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('admin/review/index', $data);
    }

    // 🗑️ HAPUS REVIEW
    public function delete($id)
    {
        $this->reviewModel->delete($id);

        return redirect()
            ->to(base_url('admin/review'))
            ->with('success', 'Review berhasil dihapus');
    }
}
