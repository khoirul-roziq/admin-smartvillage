<?php

namespace App\Controllers;

use App\Models\UserModel;

use App\Models\DataPelangganModel;
use App\Controllers\BaseController;

class User extends BaseController
{
    public function index()
    {
        if ($this->session->has('username')) {

            $userModel = new UserModel();
            $user = $userModel->findAll();

            $data = [
                'title' => 'Data Pelanggan',
                'user' => $user
            ];

            return view('templates/header', ["title" => "User Admin"]) . view('templates/menu') . view('admin/user/index', $data);
        } else {
            return redirect('/');
        }
    }

    public function edit($id)
    {
        $userModel = new UserModel();
        $user = $userModel->where(['id_user' => $id])->first();

        $data = [
            'title' => 'Data User',
            'user' => $user,
            'validation' => \Config\Services::validation()
        ];

        return view('templates/header', ["title" => "User Admin"]) . view('templates/menu') . view("admin/user/edit", $data);
    }

    public function update($id)
    {
        $userModel = new UserModel();

        if (!$this->validate([
            'nama' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'username' => 'required|is_unique[users.username]',
            'password1' => [
                'rules' => 'required|trim|min_length[8]|matches[password2]',
                'errors' => [
                    'matches' => 'Password dont match!'
                ]
            ],
            'password2' => 'required|trim|matches[password1]'
        ])) {
            $validation = \Config\Services::validation();

            session()->setFlashdata('massage', $validation->listErrors());
            return redirect()->to("user/$id/edit")->withInput()->with('validation', $validation);
        }

        $userModel->save([
            'id_user' => $id,
            'nama_lengkap' => $this->request->getPost("nama"),
            'username'  => $this->request->getPost("username"),
            'email' => $this->request->getPost("email"),
        ]);

        session()->setFlashdata('massage', 'Data Pelanggan Berhasil Diubah!');
        return redirect()->to('/user');
    }

    public function delete($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);
        session()->setFlashdata('massage', 'Data Pelanggan Berhasil Dihapus!');
        return redirect()->to('/user');
    }
}
