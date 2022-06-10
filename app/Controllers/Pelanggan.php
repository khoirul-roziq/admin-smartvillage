<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataPelangganModel;

class Pelanggan extends BaseController
{
    public function index()
    {
        $pelanggan = new DataPelangganModel();

        $data = [
            "pelanggan" => $pelanggan->findAll()
        ];

        return view('templates/header', ["title" => "Transaksi"]) . view('templates/menu') . view('admin/pelanggan', $data);
    }
}
