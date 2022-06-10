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

    public function edit($id) {
        $pelangganModel = new DataPelangganModel();
        $pelanggan = $pelangganModel->where(['id_pelanggan' => $id])->first();
        
        $data = [
            'pelanggan' => $pelanggan
        ];

        return view("pelanggan/edit", $data);
    }

    public function update($id) {
        $pelangganModel = new DataPelangganModel();
        
        $pelangganModel->save( [
            'id_pelanggan' => $id,
            'nama_pelanggan' => $this->request->getPost("namaPelanggan"),
            'nama_desa'  => $this->request->getPost("namaDesa"),
            'no_telp' => $this->request->getPost("telepon"),
            'email' => $this->request->getPost("email"),
            'alamat' => $this->request->getPost("alamat"),
        ]);
        
        session()->setFlashdata('massage', 'Data Berhasil Diubah!');
        return redirect('pelanggan');
    }
}