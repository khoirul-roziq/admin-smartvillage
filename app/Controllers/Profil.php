<?php

namespace App\Controllers;

use App\Models\ProfilModel;
use CodeIgniter\Files\File;
use App\Controllers\BaseController;

class Profil extends BaseController
{
    public function index()
    {
        if ($this->session->has('username')) {
            $profilModel = new ProfilModel();
            $profil = $profilModel->first();

            $data = [
                'profil' => $profil
            ];
            return view('templates/header', ["title" => "Profil Instansi"]) . view('templates/menu') . view('admin/profil/index', $data);
        } else {
            return redirect('/');
        }
    }

    public function edit()
    {
        $profilModel = new ProfilModel();
        $profil = $profilModel->first();

        $data = [
            'profil' => $profil,
            'validation' => \Config\Services::validation()
        ];

        return view('templates/header', ["title" => "Profil Instansi"]) . view('templates/menu') . view("admin/profil/edit", $data);
    }

    protected $helpers = ['form'];
    public function update($id)
    {

        $profilModel = new ProfilModel();

        $telepon = $this->request->getPost("telepon");
        $email = $this->request->getPost('email');

        if (!$this->validate([
            'namaInstansi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Nama Instansi"</b> tidak boleh dikosongkan!'
                ]
            ],
            'kodeNota' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Kode Nota"</b> tidak boleh dikosongkan!'
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
                    'required' => 'Kolom <b>"Email"</b> tidak boleh dikosongkan!',
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
            return redirect()->to("profil/edit")->withInput()->with('validation', $validation);
        }

        $img = $this->request->getFile('logo');
        $file = "logo." . $img->guessExtension();
        if (file_exists("uploads/logo/" . $file)) unlink("uploads/logo/" . $file);
        if (file_exists($img) && !$img->hasMoved()) {
            $img->move('uploads/logo', $file);

            $profilModel->save([
                'id' => $id,
                'nama_instansi' => $this->request->getPost("namaInstansi"),
                'kode_nota'  => $this->request->getPost("kodeNota"),
                'no_telp' => $this->request->getPost("telepon"),
                'email' => $this->request->getPost("email"),
                'alamat' => $this->request->getPost("alamat"),
                'logo' => $img->getName()
            ]);
        } else {
            $profilModel->save([
                'id' => $id,
                'nama_instansi' => $this->request->getPost("namaInstansi"),
                'kode_nota'  => $this->request->getPost("kodeNota"),
                'no_telp' => $this->request->getPost("telepon"),
                'email' => $this->request->getPost("email"),
                'alamat' => $this->request->getPost("alamat"),
            ]);
        }

        session()->setFlashdata('massage', 'Data Profil Berhasil Diubah!');
        return redirect('profil');
    }
}
