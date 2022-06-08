<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class RegistrationController extends BaseController
{
    public function index()
    {
        return view('auth/registration');
    }

    public function store()
    {
        $db = \Config\Database::connect();


        $data = [
            'username' => $this->request->getPost("username"),
            'password'  => password_hash($this->request->getPost("password"), PASSWORD_DEFAULT),
            'role_id' => '2',
        ];

        $db->table('users')->insert($data);

        return redirect('/');
    }
}
