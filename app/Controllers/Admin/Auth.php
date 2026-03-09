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

    /* ======================
     *  CHANGE PASSWORD
     * ====================== */

    public function changePassword()
    {
        // Proteksi: hanya admin login
        if (!session()->get('admin_logged_in')) {
            return redirect()->to(base_url('admin/login'));
        }

        return view('admin/auth/change_password');
    }

    public function updatePassword()
    {
        // Proteksi login
        if (!session()->get('admin_logged_in')) {
            return redirect()->to(base_url('admin/login'));
        }

        $oldPassword     = $this->request->getPost('old_password');
        $newPassword     = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        // 1️⃣ Validasi input kosong
        if (!$oldPassword || !$newPassword || !$confirmPassword) {
            return redirect()->back()->with('error', 'Semua field wajib diisi.');
        }

        // 2️⃣ Validasi konfirmasi password
        if ($newPassword !== $confirmPassword) {
            return redirect()->back()->with('error', 'Konfirmasi password tidak sesuai.');
        }

        // 3️⃣ Ambil data admin login
        $adminId = session()->get('admin_id');
        $admin   = $this->userModel->find($adminId);

        if (!$admin) {
            return redirect()->back()->with('error', 'Data admin tidak ditemukan.');
        }

        // 4️⃣ Cek password lama (INI YANG KEMARIN HILANG ❌)
        if (!password_verify($oldPassword, $admin['password'])) {
            return redirect()->back()->with('error', 'Password lama salah.');
        }

        // 5️⃣ Hash password baru
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // 6️⃣ Update ke database
        $this->userModel->update($adminId, [
            'password' => $hashedPassword
        ]);

        // 7️⃣ Pastikan benar-benar terupdate
        if ($this->userModel->affectedRows() < 1) {
            return redirect()->back()->with('error', 'Gagal memperbarui password.');
        }

        return redirect()->back()->with('success', 'Password berhasil diperbarui.');
    }

    /* ======================
     *  AUTH LOGIN
     * ====================== */

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

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel
            ->where('email', $email)
            ->where('role', 'admin')
            ->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'admin_logged_in' => true,
                'admin_id'        => $user['id'],
                'admin_name'      => $user['username'],
                'admin_email'     => $user['email']
            ]);

            return redirect()->to(base_url('admin/dashboard'));
        }

        return redirect()->to(base_url('admin/login'))
                         ->with('error', 'Email atau password salah');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('admin/login'));
    }
}
