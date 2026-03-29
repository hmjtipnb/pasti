<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;

class Anggota extends BaseController
{
    protected $anggotaModel;

    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
    }

    public function index()
    {
        if (!session()->get('admin_logged_in')) {
            return redirect()->to(base_url('admin/login'));
        }

        $search = $this->request->getGet('search');
        $query = $this->anggotaModel->orderBy('created_at', 'DESC');

        if ($search) {
            $query->groupStart()
                  ->like('nama', $search)
                  ->orLike('nim', $search)
                  ->orLike('kode_anggota', $search)
                  ->groupEnd();
        }

        $data = [
            'title'      => 'Daftar Anggota PASTI',
            'anggota'    => $query->findAll(),
            'activeMenu' => 'anggota',
            'search'     => $search ?? '',
        ];

        return view('admin/anggota/index', $data);
    }

    public function delete($id)
    {
        if (!session()->get('admin_logged_in')) {
            return redirect()->to(base_url('admin/login'));
        }

        $this->anggotaModel->delete($id);
        return redirect()->back()->with('success', 'Data anggota berhasil dihapus');
    }
}
