<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
    public function index()
    {
        if ($this->session->has('username')) {
            return view('index');
        }
        else {
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
        if ($user->where(['username' => $username, 'password' => $password])->first() != NULL) {
            $this->session->set('username', $username);
            return redirect('/');
        }
        else {
            return redirect('/');
        }
    }

    public function checkUsername()
    {
        $user = new UserModel();
        $username = $this->request->getPost("username");

        if ($user->where("username", $username)->first() != NULL) {
            $res = "true";
        }
        else {
            $res = "false";
        }

        echo json_encode(["user" => $res]);
    }

    public function checkPassword()
    {
        $user = new UserModel();
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");

        if ($user->where(["username" => $username, "password" => $password])->first() != NULL) {
            $res = "true";
        }
        else {
            $res = "false";
        }

        echo json_encode(["user" => $res]);
    }
    public function logout()
    {
        $this->session->destroy();
        return redirect('/');
    }
}
