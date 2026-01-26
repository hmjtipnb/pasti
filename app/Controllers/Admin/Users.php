<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RegistrationModel;

class Users extends BaseController
{
    protected $registrationModel;

    public function __construct()
    {
        $this->registrationModel = new RegistrationModel();
    }

    public function index()
    {
        if (!session()->get('admin_logged_in')) {
            return redirect()->to(base_url('admin/login'));
        }

        $data = [
            'title' => 'Daftar Peserta',
            'users' => $this->registrationModel->orderBy('created_at', 'DESC')->findAll(),
            'activeMenu' => 'peserta' // <-- ini variabel untuk highlight menu
        ];

        return view('admin/peserta/index', $data);
    }
}
