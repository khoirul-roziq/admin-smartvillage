<?php

namespace App\Controllers;


use App\Models\AdminModel;


class Admin extends BaseController
{
    public function index()
    {
        if ($this->session->has('username')) {
            return view('header', ["title" => "Dashboard"]) . view('menu') . view('admin/index');
        } else {
            return view('templates/auth_header', ["title" => "Login - Admin"]) . view('auth/login'). view('templates/auth_footer');
        }
    }

    public function login()
    {
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");

        $admin = new AdminModel();
        $tempPass = $admin->where(["username" => $username])->first()['password'];

        if (password_verify($password, $tempPass)) {
            $this->session->set('username', $username);
            // return redirect('/');
            echo 'success';
        } else {
            return redirect('/');
        }
    }

    public function checkUsername()
    {
        $admin = new AdminModel();
        $username = $this->request->getPost("username");

        if ($admin->where("username", $username)->first() != NULL) {
            $res = "true";
        } else {
            $res = "false";
        }

        return $this->response->setJSON(["admin" => $res, "csrfHash" => csrf_hash()]);
    }

    public function checkPassword()
    {
        $admin = new AdminModel();
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");
        $tempPass = $admin->where(["username" => $username])->first()['password'];

        if (password_verify($password, $tempPass)) {
            $res = "true";
        } else {
            $res = "false";
        }

        return $this->response->setJSON(["admin" => $res, "csrfHash" => csrf_hash()]);
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
