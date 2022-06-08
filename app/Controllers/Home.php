<?php

namespace App\Controllers;

use App\Models\UserModel;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class Home extends BaseController
{
    public function index()
    {
        if ($this->session->has('username')) {
            return view('header', ["title" => "Dashboard"]) . view('menu') . view('index');
        } else {
            return view('templates/auth_header', ["title" => "Login - Admin"]) . view('auth/login') . view('templates/auth_footer');
        }
    }

    public function login()
    {
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");

        $user = new UserModel();
        $tempPass = $user->where(["username" => $username])->first()['password'];

        var_dump(password_verify($password, $tempPass));
        die;
        if (password_verify($password, $tempPass)) {
            $this->session->set('username', $username);
            return redirect('/');
        } else {
            return redirect('/');
        }
    }

    public function checkUsername()
    {
        $user = new UserModel();
        $username = $this->request->getPost("username");

        if ($user->where("username", $username)->first() != NULL) {
            $res = "true";
        } else {
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
        } else {
            $res = "false";
        }

        echo json_encode(["user" => $res]);
    }

    public function form()
    {
        if ($this->session->has('username')) {
            return view('header', ["title" => "Form"]) . view('menu') . view('forms');
        } else {
            return view('header', ["title" => "Login - Admin"]) . view('login');
        }
    }
    public function logout()
    {
        $this->session->destroy();
        return redirect('/');
    }
}
