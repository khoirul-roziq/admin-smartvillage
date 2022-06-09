<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class BarangController extends BaseController
{
    public function index()
    {
        return view('barang/index');
    }
}
