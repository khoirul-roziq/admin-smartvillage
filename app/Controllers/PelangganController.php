<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\DataPelangganModel;

class PelangganController extends BaseController
{
    public function index()
    {
        if ($this->session->has('username')) {

            $pelangganModel = new DataPelangganModel();
            $pelanggan = $pelangganModel->findAll();

            $data = [
                'title' => 'Data Pelanggan',
                'pelanggan' => $pelanggan
            ];

            return view('templates/header', ["title" => "Pelanggan"]) . view('templates/menu') . view('admin/pelanggan/index', $data);
        } else {
            return redirect('/');
        }
    }

    public function create()
    {
        $data = [
            'title' => 'Data Pelanggan',
            'validation' => \Config\Services::validation()
        ];
        return view('templates/header', ["title" => "Pelanggan"]) . view('templates/menu') . view('admin/pelanggan/create', $data);
    }

    public function store()
    {
        $db = new DataPelangganModel();

        if (!$this->validate([
            'namaPelanggan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Nama Pelanggan"</b> tidak boleh dikosongkan!'
                ]
            ],
            'namaDesa' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Nama Desa"</b> tidak boleh dikosongkan!'
                ]
            ],
            'telepon' => [
                'rules' => 'required|trim|is_unique[data_pelanggan.no_telp]|decimal',
                'errors' => [
                    'required' => 'Kolom <b>"Nomor Telepon"</b> tidak boleh dikosongkan!',
                    'is_unique' => 'Nomor Telepon sudah terdaftar!',
                    'decimal' => 'Nomor Telepon tidak valid!'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[data_pelanggan.email]',
                'errors' => [
                    'required' => 'Kolom <b>"Nomor Telepon"</b> tidak boleh dikosongkan!',
                    'is_unique' => 'Email sudah terdaftar!',
                    'valid_email' => 'Email yang anda masukan tidak valid!'
                ]
            ],
            'alamat' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Alamat"</b> tidak boleh dikosongkan!'
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();

            session()->setFlashdata('massage', $validation->listErrors());
            return redirect()->to('pelanggan/create')->withInput()->with('validation', $validation);
        }

        $data = [
            'id_pelanggan' => uniqid(),
            'nama_pelanggan' => $this->request->getPost("namaPelanggan"),
            'nama_desa'  => $this->request->getPost("namaDesa"),
            'no_telp' => $this->request->getPost("telepon"),
            'email' => $this->request->getPost("email"),
            'alamat' => $this->request->getPost("alamat"),
        ];

        $db->table('data_pelanggan')->insert($data);
        session()->setFlashdata('massage', 'Data Pelanggan Berhasil Ditambah!');
        return redirect('pelanggan');
    }

    public function edit($id)
    {
        $pelangganModel = new DataPelangganModel();
        $pelanggan = $pelangganModel->where(['id_pelanggan' => $id])->first();

        $data = [
            'title' => 'Data Pelanggan',
            'pelanggan' => $pelanggan,
            'validation' => \Config\Services::validation()
        ];

        return view('templates/header', ["title" => "Pelanggan"]) . view('templates/menu') . view("admin/pelanggan/edit", $data);
    }

    public function update($id)
    {
        $pelangganModel = new DataPelangganModel();

        $telepon = $this->request->getPost("telepon");
        $email = $this->request->getPost('email');

        if (!$this->validate([
            'namaPelanggan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Nama Pelanggan"</b> tidak boleh dikosongkan!'
                ]
            ],
            'namaDesa' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Nama Desa"</b> tidak boleh dikosongkan!'
                ]
            ],
            'telepon' => [
                'rules' => "required|trim|is_unique[data_pelanggan.no_telp,no_telp,$telepon]|decimal",
                'errors' => [
                    'required' => 'Kolom <b>"Nomor Telepon"</b> tidak boleh dikosongkan!',
                    'is_unique' => 'Nomor Telepon sudah terdaftar!',
                    'decimal' => 'Nomor Telepon tidak valid!'
                ]
            ],
            'email' => [
                'rules' => "required|valid_email|is_unique[data_pelanggan.email,email,$email]",
                'errors' => [
                    'required' => 'Kolom <b>"Nomor Telepon"</b> tidak boleh dikosongkan!',
                    'is_unique' => 'Email sudah terdaftar!',
                    'valid_email' => 'Email yang anda masukan tidak valid!'
                ]
            ],
            'alamat' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Alamat"</b> tidak boleh dikosongkan!'
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();

            session()->setFlashdata('massage', $validation->listErrors());
            return redirect()->to("pelanggan/$id/edit")->withInput()->with('validation', $validation);
        }

        $pelangganModel->save([
            'id_pelanggan' => $id,
            'nama_pelanggan' => $this->request->getPost("namaPelanggan"),
            'nama_desa'  => $this->request->getPost("namaDesa"),
            'no_telp' => $this->request->getPost("telepon"),
            'email' => $this->request->getPost("email"),
            'alamat' => $this->request->getPost("alamat"),
        ]);

        session()->setFlashdata('massage', 'Data Pelanggan Berhasil Diubah!');
        return redirect('pelanggan');
    }

    public function delete($id)
    {
        $pelangganModel = new DataPelangganModel();
        $pelangganModel->delete($id);
        session()->setFlashdata('massage', 'Data Pelanggan Berhasil Dihapus!');
        return redirect('pelanggan');
    }
}
