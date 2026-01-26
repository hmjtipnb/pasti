<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if (session()->get('admin_logged_in')) {
            return redirect()->to(base_url('admin/dashboard'));
        }

        return view('admin/auth/login', ['title' => 'Login Admin']);
    }

    public function authenticate()
    {
        $session = session();

        // Ambil input email & password
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Cari user di database berdasarkan email
        $user = $this->userModel->where('email', $email)->first();

        // Cek user ada & password cocok & role admin
        if ($user && password_verify($password, $user['password']) && $user['role'] === 'admin') {
            $session->set([
                'admin_logged_in' => true,
                'admin_id'        => $user['id'],
                'admin_name'      => $user['username'],
                'admin_email'     => $user['email']
            ]);
            return redirect()->to(base_url('admin/dashboard'));
        }

        // Jika gagal login
        $session->setFlashdata('error', 'Email atau password salah');
        return redirect()->to(base_url('admin/login'));
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('admin/login'));
    }
}
