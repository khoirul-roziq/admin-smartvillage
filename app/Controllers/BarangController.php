<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataBarangModel;

class BarangController extends BaseController
{
    public function index()
    {
        if ($this->session->has('username')) {

            $barangModel = new DataBarangModel();
            $barang = $barangModel->findAll();

            $data = [
                'title' => 'Data Barang',
                'barang' => $barang
            ];

            return view('templates/header', ["title" => "Barang"]) . view('templates/menu') . view('admin/barang/index', $data);
        } else {
            return redirect('/');
        }
    }

    public function create()
    {
        $data = [
            'title' => 'Data Barang',
            'validation' => \Config\Services::validation()
        ];
        return view('templates/header', ["title" => "Barang"]) . view('templates/menu') . view('admin/barang/create', $data);
    }

    public function store()
    {
        $db = new DataBarangModel();

        if (!$this->validate([
            'kodeBarang' => [
                'rules' => 'required|trim|is_unique[data_barang.kode_barang]|max_length[4]|min_length[4]',
                'errors' => [
                    'required' => 'Kolom <b>"Kode Barang"</b> tidak boleh dikosongkan!',
                    'is_unique' => 'Kode Barang sudah digunakan!',
                    'max_length' => 'Masukan 4 karakter untuk kolom <b>"Kode Barang"</b>',
                    'min_length' => 'Masukan 4 karakter untuk kolom <b>"Kode Barang"</b>'
                ]
            ],
            'namaBarang' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Nama Barang"</b> tidak boleh dikosongkan!'
                ]
            ],
            'hargaBarang' => [
                'rules' => 'required|trim|numeric',
                'errors' => [
                    'required' => 'Kolom <b>"Harga"</b> tidak boleh dikosongkan!',
                    'numeric' => 'Karakter yang anda isikan tidak valid!'
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();

            session()->setFlashdata('massage', $validation->listErrors());
            return redirect()->to('barang/create')->withInput()->with('validation', $validation);
        }

        $data = [
            'kode_barang' => $this->request->getPost("kodeBarang"),
            'nama_barang'  => $this->request->getPost("namaBarang"),
            'harga_barang' => $this->request->getPost("hargaBarang"),
        ];

        $db->table('data_barang')->insert($data);
        session()->setFlashdata('massage', 'Data Barang Berhasil Ditambah!');
        return redirect('barang');
    }

    public function edit($kodeBarang)
    {
        $barangModel = new DataBarangModel();
        $barang = $barangModel->where(['kode_barang' => $kodeBarang])->first();

        $data = [
            'title' => 'Data Barang',
            'barang' => $barang,
            'validation' => \Config\Services::validation()
        ];

        return view('templates/header', ["title" => "Barang"]) . view('templates/menu') . view("admin/barang/edit", $data);
    }

    public function update($kodeBarang)
    {
        $barangModel = new DataBarangModel();

        if (!$this->validate([
            'kodeBarang' => [
                'rules' => "required|trim|is_unique[data_barang.kode_barang,kode_barang,$kodeBarang]|max_length[4]|min_length[4]",
                'errors' => [
                    'required' => 'Kolom <b>"Kode Barang"</b> tidak boleh dikosongkan!',
                    'is_unique' => 'Kode Barang sudah digunakan!',
                    'max_length' => 'Masukan 4 karakter untuk kolom <b>"Kode Barang"</b>',
                    'min_length' => 'Masukan 4 karakter untuk kolom <b>"Kode Barang"</b>'
                ]
            ],
            'namaBarang' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Nama Barang"</b> tidak boleh dikosongkan!'
                ]
            ],
            'hargaBarang' => [
                'rules' => 'required|trim|numeric',
                'errors' => [
                    'required' => 'Kolom <b>"Harga"</b> tidak boleh dikosongkan!',
                    'numeric' => 'Karakter yang anda isikan tidak valid!'
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();

            session()->setFlashdata('massage', $validation->listErrors());
            return redirect()->to("barang/$kodeBarang/edit")->withInput()->with('validation', $validation);
        }

        $barangModel->save([
            'kode_barang' => $this->request->getPost("kodeBarang"),
            'nama_barang'  => $this->request->getPost("namaBarang"),
            'harga_barang' => $this->request->getPost("hargaBarang"),
        ]);

        session()->setFlashdata('massage', 'Data Barang Berhasil Diubah!');
        return redirect('barang');
    }

    public function delete($kodeBarang)
    {
        $barangModel = new DataBarangModel();
        $barangModel->delete($kodeBarang);
        session()->setFlashdata('massage', 'Data barang Berhasil Dihapus!');
        return redirect('barang');
    }
}
