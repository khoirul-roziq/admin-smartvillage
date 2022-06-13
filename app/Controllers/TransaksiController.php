<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;
use App\Models\PksModel;
use App\Models\BarangModel;
use App\Models\LayananModel;
use App\Models\PelangganModel;

class TransaksiController extends BaseController
{
    public function index()
    {
        $transaksiModel = new TransaksiModel();
        $transaksi = $transaksiModel->findAll();
        
        $data = [
            'title' => 'Transaksi',
            'transaksi' => $transaksi
        ];

        return view('main/transaksi/index', $data);
    }

    public function create() {
        $pks = new PksModel();
        $barang = new BarangModel();
        $layanan = new LayananModel();
        $pelanggan = new PelangganModel();

        $data = [
            'title' => 'Transaksi',
            'pks' => $pks->findAll(),
            'barang' => $barang->findAll(),
            'layanan' => $layanan->findAll(),
            'pelanggan' => $pelanggan->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('main/transaksi/create',$data);
    }

    public function store() {
        $db = new TransaksiModel();

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
        session()->setFlashdata('massage', 'Transaksi Berhasil Ditambah!');
        return redirect('transaksi');
    }

    public function edit($kodeBarang) {
        $transaksiModel = new TransaksiModel();
        $transaksi = $transaksiModel->where(['kode_barang' => $kodeBarang])->first();
        
        $data = [
            'title' => 'Transaksi',
            'transaksi' => $transaksi,
            'validation' => \Config\Services::validation()
        ];

        return view("main/transaksi/edit", $data);
    }

    public function update($kodeBarang) {
        $transaksiModel = new TransaksiModel();

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
        
        $transaksiModel->save( [
            'kode_barang' => $this->request->getPost("kodeBarang"),
            'nama_barang'  => $this->request->getPost("namaBarang"),
            'harga_barang' => $this->request->getPost("hargaBarang"),
        ]);
        
        session()->setFlashdata('massage', 'Transaksi Berhasil Diubah!');
        return redirect('transaksi');
    }

    public function delete($kodeBarang) {
        $transaksiModel = new TransaksiModel();
        $transaksiModel->delete($kodeBarang);
        session()->setFlashdata('massage', 'Transaksi Berhasil Dihapus!');
        return redirect('transaksi');
    }
}
