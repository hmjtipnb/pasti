<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RegistrationModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        // 🔐 KEAMANAN DI SINI
        if (!session()->get('admin_logged_in')) {
            redirect()->to(base_url('admin/login'))->send();
            exit;
        }
    }

    public function index()
    {
        $registrationModel = new RegistrationModel();

        // Total peserta
        $totalPeserta = $registrationModel->countAllResults();
        $totalOffline = $registrationModel->where('sesi', 'Offline')->countAllResults();
        $totalOnline  = $registrationModel->where('sesi', 'Online')->countAllResults();

        // Default bulan & tahun
        $bulanFilter = $this->request->getGet('bulan') ?? date('m');
        $tahunFilter = $this->request->getGet('tahun') ?? date('Y');

        // Query grafik
        $builder = $registrationModel->builder();
        $query = $builder->select("DAY(created_at) as hari, COUNT(*) as jumlah, sesi")
                         ->where("MONTH(created_at)", $bulanFilter)
                         ->where("YEAR(created_at)", $tahunFilter)
                         ->groupBy("hari, sesi")
                         ->orderBy("hari", "ASC")
                         ->get()->getResultArray();

        $jumlahHari = date('t', strtotime("$tahunFilter-$bulanFilter-01"));
        $labels = [];
        $offlinePerHari = [];
        $onlinePerHari = [];

        for ($i = 1; $i <= $jumlahHari; $i++) {
            $labels[] = $i;
            $offlinePerHari[$i] = 0;
            $onlinePerHari[$i] = 0;
        }

        foreach ($query as $row) {
            if ($row['sesi'] === 'Offline') {
                $offlinePerHari[$row['hari']] = (int)$row['jumlah'];
            } else {
                $onlinePerHari[$row['hari']] = (int)$row['jumlah'];
            }
        }

        $data = [
            'totalPeserta'     => $totalPeserta,
            'totalOffline'     => $totalOffline,
            'totalOnline'      => $totalOnline,
            'bulan'            => $labels,
            'offlinePerBulan'  => array_values($offlinePerHari),
            'onlinePerBulan'   => array_values($onlinePerHari),
            'selectedBulan'    => $bulanFilter,
            'selectedTahun'    => $tahunFilter
        ];

        return view('admin/dashboard/index', $data);
    }
}
