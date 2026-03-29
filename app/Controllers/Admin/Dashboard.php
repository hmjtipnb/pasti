<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RegistrationModel;
use App\Models\AnggotaModel;

class Dashboard extends BaseController
{
    public function __construct()
    { 
        if (!session()->get('admin_logged_in')) {
            redirect()->to(base_url('admin/login'))->send();
            exit;
        }
    }

    public function index()
    {
        $registrationModel = new RegistrationModel();
        $anggotaModel = new AnggotaModel();
 
        $totalSeminar = $registrationModel->countAllResults();
        $totalOffline = $registrationModel->where('sesi', 'Offline')->countAllResults();
        $totalOnline  = $registrationModel->where('sesi', 'Online')->countAllResults();
        $totalAnggota = $anggotaModel->countAllResults();
        
        // Anggota per Divisi (Pie Chart)
        $divisiData = $anggotaModel->select('divisi, COUNT(*) as jumlah')
                                   ->groupBy('divisi')
                                   ->get()->getResultArray();

        $bulanFilter = $this->request->getGet('bulan') ?? date('m');
        $tahunFilter = $this->request->getGet('tahun') ?? date('Y');

        // Query Grafik Seminar (Peserta)
        $builderSeminar = $registrationModel->builder();
        $querySeminar = $builderSeminar->select("DAY(created_at) as hari, COUNT(*) as jumlah, sesi")
                         ->where("MONTH(created_at)", $bulanFilter)
                         ->where("YEAR(created_at)", $tahunFilter)
                         ->groupBy("hari, sesi")
                         ->get()->getResultArray();

        // Query Grafik Anggota
        $builderAnggota = $anggotaModel->builder();
        $queryAnggota = $builderAnggota->select("DAY(created_at) as hari, COUNT(*) as jumlah")
                         ->where("MONTH(created_at)", $bulanFilter)
                         ->where("YEAR(created_at)", $tahunFilter)
                         ->groupBy("hari")
                         ->get()->getResultArray();

        $jumlahHari = date('t', strtotime("$tahunFilter-$bulanFilter-01"));
        $labels = [];
        $offlinePerHari = [];
        $onlinePerHari = [];
        $anggotaPerHari = [];

        for ($i = 1; $i <= $jumlahHari; $i++) {
            $labels[] = $i;
            $offlinePerHari[$i] = 0;
            $onlinePerHari[$i] = 0;
            $anggotaPerHari[$i] = 0;
        }

        foreach ($querySeminar as $row) {
            if ($row['sesi'] === 'Offline') {
                $offlinePerHari[$row['hari']] = (int)$row['jumlah'];
            } else {
                $onlinePerHari[$row['hari']] = (int)$row['jumlah'];
            }
        }

        foreach ($queryAnggota as $row) {
            $anggotaPerHari[$row['hari']] = (int)$row['jumlah'];
        }

        $data = [
            'totalSeminar'     => $totalSeminar,
            'totalOffline'     => $totalOffline,
            'totalOnline'      => $totalOnline,
            'totalAnggota'     => $totalAnggota,
            'divisiData'       => $divisiData,
            'labels'           => $labels,
            'offlinePerHari'   => array_values($offlinePerHari),
            'onlinePerHari'    => array_values($onlinePerHari),
            'anggotaPerHari'   => array_values($anggotaPerHari),
            'selectedBulan'    => $bulanFilter,
            'selectedTahun'    => $tahunFilter,
            'title'            => 'Admin Dashboard',
            'activeMenu'       => 'dashboard'
        ];

        return view('admin/dashboard/index', $data);
    }
}
