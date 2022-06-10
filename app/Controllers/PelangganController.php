<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataPelangganModel;

class PelangganController extends BaseController
{
    public function index()
    {
        $pelangganModel = new DataPelangganModel();
        $pelanggan = $pelangganModel->findAll();
        
        $data = [
            'pelanggan' => $pelanggan
        ];

        return view('pelanggan/index', $data);
    }

    public function create() {
        return view('pelanggan/create');
    }

    public function store() {
        $db = new DataPelangganModel();

        $data = [
            'nama_pelanggan' => $this->request->getPost("namaPelanggan"),
            'nama_desa'  => $this->request->getPost("namaDesa"),
            'no_telp' => $this->request->getPost("telepon"),
            'email' => $this->request->getPost("email"),
            'alamat' => $this->request->getPost("alamat"),
        ];

        $db->table('data_pelanggan')->insert($data);
        session()->setFlashdata('massage', 'Tambah Data Berhasil!');
        return redirect('pelanggan');
    }
}
