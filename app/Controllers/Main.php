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

            $transaksi->join("layanan_order", "layanan_order.id_transaksi= data_transaksi.id_transaksi", "left")
                ->join("barang_order", "barang_order.id_transaksi= data_transaksi.id_transaksi", "left");

            foreach ($transaksi->findAll() as $order) {
                if ($order["kode_barang"] == NULL) {
                    $transaksi->update(["id_transaksi" => $order["id_transaksi"]], ["total" => $order["harga_layanan"]]);
                } else if ($order["kode_layanan"] == NULL) {
                    $transaksi->update(["id_transaksi" => $order["id_transaksi"]], ["total" => $order["harga_barang"] * $order["qty"]]);
                } else {
                    $transaksi->update(["id_transaksi" => $order["id_transaksi"]], ["total" => $order["harga_barang"] * $order["qty"] + $order["harga_layanan"]]);
                }
            }

            $id_pelanggan = $transaksi->select("data_transaksi.id_pelanggan")->join("data_pelanggan", "data_pelanggan.id_pelanggan = data_transaksi.id_pelanggan", "inner")->orderBy("data_transaksi.id_pelanggan")->first();
            $nama_pelanggan = $transaksi->select("nama_pelanggan")->join("data_pelanggan", "data_pelanggan.id_pelanggan = data_transaksi.id_pelanggan", "inner")->orderBy("data_transaksi.id_pelanggan")->first();
            $nama_desa = $transaksi->select("nama_desa")->join("data_pelanggan", "data_pelanggan.id_pelanggan = data_transaksi.id_pelanggan", "inner")->orderBy("data_transaksi.id_pelanggan")->first();
            $total = $transaksi->select("total")->orderBy("data_transaksi.id_pelanggan")->first();
            $tanggal = $transaksi->select("tanggal")->orderBy("data_transaksi.id_pelanggan")->first();
            $status = $transaksi->select("status")->orderBy("data_transaksi.id_pelanggan")->first();
            $temp_tanggal = $transaksi->select("tanggal")->orderBy("data_transaksi.id_pelanggan")->first();
            $temp_pelanggan = $transaksi->select("id_pelanggan")->orderBy("data_transaksi.id_pelanggan")->first();

            if ($id_pelanggan != NULL) {
                $data = [
                    [
                        "id_pelanggan" => $id_pelanggan["id_pelanggan"],
                        "nama_pelanggan" => $nama_pelanggan["nama_pelanggan"],
                        "nama_desa" => $nama_desa["nama_desa"],
                        "total" => $total["total"],
                        "status" => $status["status"],
                        "tanggal" => $tanggal["tanggal"]
                    ]
                ];

                $total = [];
                $temp_total = 0;
                $last_total = 0;

                $transaksi->join("data_pelanggan", "data_pelanggan.id_pelanggan = data_transaksi.id_pelanggan", "inner");

                foreach ($transaksi->orderBy("data_transaksi.id_pelanggan")->findAll() as $order) {
                    if ($order["id_pelanggan"] == $temp_pelanggan["id_pelanggan"] and $order["tanggal"] == $temp_tanggal["tanggal"]) {
                        $temp_total += $order["total"];
                        $last_total = $temp_total;
                    } else {
                        array_push($total, $temp_total);
                        $temp_total = $order["total"];
                        $temp_pelanggan["id_pelanggan"] = $order["id_pelanggan"];
                        $temp_tanggal["tanggal"] = $order["tanggal"];
                        $last_total = $order["total"];

                        $data2 = [
                            "id_pelanggan" => $order["id_pelanggan"],
                            "nama_pelanggan" => $order["nama_pelanggan"],
                            "nama_desa" => $order["nama_desa"],
                            "total" => $order["total"],
                            "status" => $order["status"],
                            "tanggal" => $order["tanggal"]
                        ];
                        array_push($data, $data2);
                    }
                }

                array_push($total, $last_total);

                $data_transaksi = [];
                foreach ($data as $index => $order) {
                    $data2 = [
                        "id_pelanggan" => $order["id_pelanggan"],
                        "nama_pelanggan" => $order["nama_pelanggan"],
                        "nama_desa" => $order["nama_desa"],
                        "total" => $total[$index],
                        "status" => $order["status"],
                        "tanggal" => $order["tanggal"]
                    ];
                    array_push($data_transaksi, $data2);
                }
                return view('templates/header', ["title" => "Dashboard"]) . view('templates/menu') .
                    view(
                        'admin/dashboard/index',
                        [
                            "transaksi" => $transaksi->join("layanan_order", "layanan_order.id_transaksi= data_transaksi.id_transaksi", "left")
                                ->join("barang_order", "barang_order.id_transaksi= data_transaksi.id_transaksi", "left")->findAll(),
                            "barang" => $barang->findALL(),
                            "layanan" => $layanan->findAll(),
                            "heading" => $data_transaksi
                        ]
                    );
            } else {
                return view('templates/header', ["title" => "Dashboard"]) . view('templates/menu') .
                    view(
                        'admin/dashboard/index',
                        [
                            "transaksi" => $transaksi->findAll(),
                            "barang" => $barang->findALL(), "layanan" => $layanan->findAll(),
                            "heading" => $transaksi->findAll()
                        ]
                    );
            }
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
            $this->session->set(['username' => $username, 'role_id' => $user->where(["username" => $username])->first()['role_id']]);
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

    public function checkEmail()
    {
        $user = new UserModel();
        $username = $this->request->getPost("username");
        $email = $this->request->getPost("email");

        if ($user->where(["username" => $username, "email" => $email])->first() != NULL) {
            $res = "true";
        } else {
            $res = "false";
        }

        return $this->response->setJSON(["user" => $res, "csrfHash" => csrf_hash()]);
    }

    public function forgot()
    {
        return view('templates/header', ["title" => "Login - Admin"]) . view('auth/edit');
    }
    public function update()
    {
        $user = new UserModel();

        $data = [
            "password" => password_hash($this->request->getPost("password"), PASSWORD_DEFAULT),
        ];
        $id_user = $user->where("username", $this->request->getPost('username'))->first()['id_user'];
        $user->update($id_user, $data);
        return redirect()->to('/');
    }
    public function logout()
    {
        $this->session->destroy();
        return redirect('/');
    }
}
