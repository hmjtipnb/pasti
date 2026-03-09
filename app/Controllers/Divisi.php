<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Divisi extends BaseController
{
    public function visual()
    {
        return view('divisi/visual');
    }

    public function web()
    {
        return view('divisi/web');
    }
    public function kti()
    {
        return view('divisi/kti');
    }
}
