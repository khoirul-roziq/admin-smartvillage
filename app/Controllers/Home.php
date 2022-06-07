<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
    public function index()
    {
        $this->session->destroy();
        if ($this->session->has('username')) {
            return view('index');
        } else {
            return view('login');
        }
    }

    public function login()
    {
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");

        $user = new UserModel();
        // var_dump($user->where(['username' => $username, 'password' => $password]));
        var_dump($user->where('username', $username));
        if ($user->where(['username' => $username, 'password' => $password]) != NULL) {
            $this->session->set('username', $username);
            return redirect('/');
        } else {
            return redirect('/');
        }
    }
}
