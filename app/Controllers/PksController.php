<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PksModel;

class PksController extends BaseController
{
    public function index()
    {
        $pksModel = new PksModel();
        $pks = $pksModel->findAll();
        
        $data = [
            'title' => 'Perjanjian Kerjasama',
            'pks' => $pks
        ];

        return view('main/pks/index', $data);
    }

    public function create() {
        $data = [
            'title' => 'Perjanjian Kerjasama',
            'validation' => \Config\Services::validation()
        ];
        return view('main/pks/create',$data);
    }

    public function store() {
        $db = new PksModel();

        if (!$this->validate([
            'namaDesa' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Nama Desa"</b> tidak boleh dikosongkan!'
                ]
            ],
            'namaKades' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Nama Kades"</b> tidak boleh dikosongkan!'
                ]
            ],
            'tanggalPks' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Tanggal PKS"</b> tidak boleh dikosongkan!'
                ]
            ],
            
        ])) {
            $validation = \Config\Services::validation();
            
            session()->setFlashdata('massage', $validation->listErrors());
            return redirect()->to('pks/create')->withInput()->with('validation', $validation);
        }

        $data = [
            'nama_desa' => $this->request->getPost("namaDesa"),
            'nama_kades'  => $this->request->getPost("namaKades"),
            'tanggal_pks' => $this->request->getPost("tanggalPks"),
        ];

        $db->table('perjanjian_kerjasama')->insert($data);
        session()->setFlashdata('massage', 'Perjanjian Kerjasama Berhasil Ditambah!');
        return redirect('pks');
    }

    public function edit($id) {
        $pksModel = new PksModel();
        $pks = $pksModel->where(['id_pks' => $id])->first();
        
        $data = [
            'title' => 'Perjanjian Kerjasama',
            'pks' => $pks,
            'validation' => \Config\Services::validation()
        ];

        return view("main/pks/edit", $data);
    }

    public function update($id) {
        $pksModel = new PksModel();

        if (!$this->validate([
            'namaDesa' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Nama Desa"</b> tidak boleh dikosongkan!'
                ]
            ],
            'namaKades' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Nama Kades"</b> tidak boleh dikosongkan!'
                ]
            ],
            'tanggalPks' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Tanggal PKS"</b> tidak boleh dikosongkan!'
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();
            
            session()->setFlashdata('massage', $validation->listErrors());
            return redirect()->to("barang/$id/edit")->withInput()->with('validation', $validation);
        }
        
        $pksModel->save( [
            'id_pks' => $id,
            'nama_desa' => $this->request->getPost("namaDesa"),
            'nama_kades'  => $this->request->getPost("namaKades"),
            'tanggal_pks' => $this->request->getPost("tanggalPks"),
        ]);
        
        session()->setFlashdata('massage', 'Perjanjian Kerjasama Berhasil Diubah!');
        return redirect('pks');
    }

    public function delete($id) {
        $pksModel = new PksModel();
        $pksModel->delete($id);
        session()->setFlashdata('massage', 'Perjanjian Kerjasama Berhasil Dihapus!');
        return redirect('pks');
    }
}
