<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DataBarangModel;
use App\Models\DataTransaksiModel;
use App\Controllers\BaseController;
use App\Models\DataLayananModel;

class Main extends BaseController
{
    public function index()
    {
        if ($this->session->has('username')) {
            $transaksi = new DataTransaksiModel();
            $barang = new DataBarangModel();
            $layanan = new DataLayananModel();
            return view('templates/header', ["title" => "Dashboard"]) . view('templates/menu') . view('admin/dashboard/index', ["transaksi" => $transaksi->findAll(), "barang" => $barang->findALL(), "layanan" => $layanan->findAll()]);
        } else {
            return view('templates/header', ["title" => "Login - Admin"]) . view('auth/login');
        }
    }

    public function login()
    {
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");

        $user = new UserModel();
        $tempPass = $user->where(["username" => $username])->first()['password'];

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

        return $this->response->setJSON(["user" => $res, "csrfHash" => csrf_hash()]);
    }

    public function checkPassword()
    {
        $user = new UserModel();
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");
        $tempPass = $user->where(["username" => $username])->first()['password'];

        if (password_verify($password, $tempPass)) {
            $res = "true";
        } else {
            $res = "false";
        }

        return $this->response->setJSON(["user" => $res, "csrfHash" => csrf_hash()]);
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect('/');
    }
}
