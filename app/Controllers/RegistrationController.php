<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class RegistrationController extends BaseController
{
    public function index()
    {
        $data = [
            'validation' => \Config\Services::validation()
        ];
        return view('auth/registration', $data);
    }

    public function store()
    {
        $db = \Config\Database::connect();

        if (!$this->validate([
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
            'password'  => password_hash($this->request->getPost("password1"), PASSWORD_DEFAULT),
            'role_id' => '2',
        ];

        $db->table('users')->insert($data);
        session()->setFlashdata('massage', 'Congratulation! Your account has been created. Please login now!');
        return redirect('/');
    }
}
