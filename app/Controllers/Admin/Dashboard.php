<?php  

namespace App\Controllers\Admin;  

use App\Controllers\BaseController;  
use App\Models\RegistrationModel;

class Dashboard extends BaseController 
{     
    public function index()     
    {         
        // Proteksi halaman admin
        if (!session()->get('admin_logged_in')) {             
            return redirect()->to(base_url('admin/login'));         
        }  

        $registrationModel = new RegistrationModel();

        // Hitung total peserta
        $totalPeserta = $registrationModel->countAllResults();

        // Hitung total per sesi
        $totalOffline = $registrationModel->where('sesi', 'Offline')->countAllResults();
        $totalOnline  = $registrationModel->where('sesi', 'Online')->countAllResults();

        $data = [     
            'title' => 'Dashboard Admin',     
            'activeMenu' => 'dashboard',
            'totalPeserta' => $totalPeserta,
            'totalOffline' => $totalOffline,
            'totalOnline'  => $totalOnline
        ]; 

        return view('admin/dashboard/index', $data);      
    } 
}
