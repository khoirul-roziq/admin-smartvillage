<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataLayananModel;

class LayananController extends BaseController
{
    public function index()
    {
        if ($this->session->has('username')) {

            $layananModel = new DataLayananModel();
            $layanan = $layananModel->findAll();

            $data = [
                'title' => 'Data Layanan',
                'layanan' => $layanan
            ];

            return view('templates/header', ["title" => "Layanan"]) . view('templates/menu') . view('admin/layanan/index', $data);
        } else {
            return redirect('/');
        }
    }

    public function create()
    {
        $data = [
            'title' => 'Data Layanan',
            'validation' => \Config\Services::validation()
        ];
        return view('templates/header', ["title" => "Layanan"]) . view('templates/menu') . view('admin/layanan/create', $data);
    }

    public function store()
    {
        $db = new DataLayananModel();

        if (!$this->validate([
            'kodeLayanan' => [
                'rules' => 'required|trim|is_unique[data_layanan.kode_layanan]|max_length[4]|min_length[4]',
                'errors' => [
                    'required' => 'Kolom <b>"Kode Layanan"</b> tidak boleh dikosongkan!',
                    'is_unique' => 'Kode Barang sudah digunakan!',
                    'max_length' => 'Masukan 4 karakter untuk kolom <b>"Kode Layanan"</b>',
                    'min_length' => 'Masukan 4 karakter untuk kolom <b>"Kode Layanan"</b>'
                ]
            ],
            'namaLayanan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Nama Layanan"</b> tidak boleh dikosongkan!'
                ]
            ],
            'hargaLayanan' => [
                'rules' => 'required|trim|numeric',
                'errors' => [
                    'required' => 'Kolom <b>"Harga"</b> tidak boleh dikosongkan!',
                    'numeric' => 'Karakter yang anda isikan tidak valid!'
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();

            session()->setFlashdata('massage', $validation->listErrors());
            return redirect()->to('layanan/create')->withInput()->with('validation', $validation);
        }

        $data = [
            'kode_layanan' => $this->request->getPost("kodeLayanan"),
            'nama_layanan'  => $this->request->getPost("namaLayanan"),
            'harga_layanan' => $this->request->getPost("hargaLayanan"),
        ];

        $db->table('data_layanan')->insert($data);
        session()->setFlashdata('massage', 'Data Layanan Berhasil Ditambah!');
        return redirect('layanan');
    }

    public function edit($kodeLayanan)
    {
        $layananModel = new DataLayananModel();
        $layanan = $layananModel->where(['kode_layanan' => $kodeLayanan])->first();

        $data = [
            'title' => 'Data Layanan',
            'layanan' => $layanan,
            'validation' => \Config\Services::validation()
        ];

        return view('templates/header', ["title" => "Layanan"]) . view('templates/menu') . view("admin/layanan/edit", $data);
    }

    public function update($kodeLayanan)
    {
        $layananModel = new DataLayananModel();

        if (!$this->validate([
            'kodeLayanan' => [
                'rules' => "required|trim|is_unique[data_layanan.kode_layanan,kode_layanan,$kodeLayanan]|max_length[4]|min_length[4]",
                'errors' => [
                    'required' => 'Kolom <b>"Kode Layanan"</b> tidak boleh dikosongkan!',
                    'is_unique' => 'Kode Barang sudah digunakan!',
                    'max_length' => 'Masukan 4 karakter untuk kolom <b>"Kode Layanan"</b>',
                    'min_length' => 'Masukan 4 karakter untuk kolom <b>"Kode Layanan"</b>'
                ]
            ],
            'namaLayanan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Nama Layanan"</b> tidak boleh dikosongkan!'
                ]
            ],
            'hargaLayanan' => [
                'rules' => 'required|trim|numeric',
                'errors' => [
                    'required' => 'Kolom <b>"Harga"</b> tidak boleh dikosongkan!',
                    'numeric' => 'Karakter yang anda isikan tidak valid!'
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();

            session()->setFlashdata('massage', $validation->listErrors());
            return redirect()->to("barang/$kodeLayanan/edit")->withInput()->with('validation', $validation);
        }

        $layananModel->save([
            'kode_layanan' => $this->request->getPost("kodeLayanan"),
            'nama_layanan'  => $this->request->getPost("namaLayanan"),
            'harga_layanan' => $this->request->getPost("hargaLayanan"),
        ]);

        session()->setFlashdata('massage', 'Data Layanan Berhasil Diubah!');
        return redirect('layanan');
    }

    public function delete($kodeLayanan)
    {
        $layananModel = new DataLayananModel();
        $layananModel->delete($kodeLayanan);
        session()->setFlashdata('massage', 'Data Layanan Berhasil Dihapus!');
        return redirect('layanan');
    }
}
