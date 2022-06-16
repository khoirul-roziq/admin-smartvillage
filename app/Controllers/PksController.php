<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\PerjanjianKerjasamaModel;

class PksController extends BaseController
{
    public function index()
    {
        if ($this->session->has('username')) {

            $pksModel = new PerjanjianKerjasamaModel();
            $pks = $pksModel->findAll();

            $data = [
                'title' => 'Perjanjian Kerjasama',
                'pks' => $pks
            ];

            return view('templates/header', ["title" => "PKS"]) . view('templates/menu') . view('admin/pks/index', $data);
        } else {
            return redirect('/');
        }
    }

    public function create()
    {
        $data = [
            'title' => 'Perjanjian Kerjasama',
            'validation' => \Config\Services::validation()
        ];
        return view('templates/header', ["title" => "PKS"]) . view('templates/menu') . view('admin/pks/create', $data);
    }

    public function store()
    {
        $db = new PerjanjianKerjasamaModel();

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
            'id_pks' => uniqid(),
            'nama_desa' => $this->request->getPost("namaDesa"),
            'nama_kades'  => $this->request->getPost("namaKades"),
            'tanggal' => $this->request->getPost("tanggalPks"),
        ];

        $db->table('perjanjian_kerjasama')->insert($data);
        session()->setFlashdata('massage', 'Perjanjian Kerjasama Berhasil Ditambah!');
        return redirect('pks');
    }

    public function edit($id)
    {
        $pksModel = new PerjanjianKerjasamaModel();
        $pks = $pksModel->where(['id_pks' => $id])->first();

        $data = [
            'title' => 'Perjanjian Kerjasama',
            'pks' => $pks,
            'validation' => \Config\Services::validation()
        ];

        return view('templates/header', ["title" => "PKS"]) . view('templates/menu') . view("admin/pks/edit", $data);
    }

    public function update($id)
    {
        $pksModel = new PerjanjianKerjasamaModel();

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

        $pksModel->save([
            'id_pks' => $id,
            'nama_desa' => $this->request->getPost("namaDesa"),
            'nama_kades'  => $this->request->getPost("namaKades"),
            'tanggal' => $this->request->getPost("tanggalPks"),
        ]);

        session()->setFlashdata('massage', 'Perjanjian Kerjasama Berhasil Diubah!');
        return redirect('pks');
    }

    public function delete($id)
    {
        $pksModel = new PerjanjianKerjasamaModel();
        $pksModel->delete($id);
        session()->setFlashdata('massage', 'Perjanjian Kerjasama Berhasil Dihapus!');
        return redirect('pks');
    }
}
