<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class RegistrationController extends BaseController
{
    public function index()
    {
        if ($this->session->has('username') && $this->session->get('role_id') == 321) {
            $data = [
                'validation' => \Config\Services::validation()
            ];
            return view('templates/header', ["title" => "Admin"]) . view('templates/menu') . view('auth/create', $data);
        } else {
            return redirect('/');
        }
    }

    public function store()
    {
        $db = \Config\Database::connect();

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
            return redirect()->to('/registration')->withInput()->with('validation', $validation);
        }

        $data = [
            'id_user' => uniqid(),
            'username' => $this->request->getPost("username"),
            'nama_lengkap' => $this->request->getPost("nama"),
            'email' => $this->request->getPost("email"),
            'password'  => password_hash($this->request->getPost("password1"), PASSWORD_DEFAULT),
            'role_id' => '2',
        ];

        $db->table('users')->insert($data);
        session()->setFlashdata('massage', 'Admin Berhasil Ditambahkan');
        return redirect()->to('/registration');
    }
}
