<?php

namespace App\Controllers;

use App\Models\DataPelangganModel;
use App\Controllers\BaseController;
use App\Models\DataBarangModel;
use App\Models\DataTransaksiModel;
use App\Models\DataLayananModel;
use App\Models\PerjanjianKerjasamaModel;
use DateTime;
use Kint\Zval\Value;

class Transaksi extends BaseController
{
    public function index()
    {
        $transaksi = new DataTransaksiModel();

        if ($this->session->has('username')) {
            foreach ($transaksi->findAll() as $order) {
                if ($order["kode_barang"] == NULL) {
                    $transaksi->join("data_layanan", "data_layanan.kode_layanan = data_transaksi.kode_layanan", "inner");

                    foreach ($transaksi->where("id_transaksi", $order["id_transaksi"])->findAll() as $harga) {
                        $transaksi->update(["id_transaksi" => $harga["id_transaksi"]], ["total" => $harga["harga_layanan"]]);
                    }
                } else if ($order["kode_layanan"] == NULL) {
                    $transaksi->join("data_barang", "data_barang.kode_barang = data_transaksi.kode_barang", "inner");

                    foreach ($transaksi->where("id_transaksi", $order["id_transaksi"])->findAll() as $harga) {
                        $transaksi->update(["id_transaksi" => $harga["id_transaksi"]], ["total" => $harga["harga_barang"] * $order["qty"]]);
                    }
                } else {
                    $transaksi->join("data_barang", "data_barang.kode_barang = data_transaksi.kode_barang", "inner");
                    $transaksi->join("data_layanan", "data_layanan.kode_layanan = data_transaksi.kode_layanan", "inner");

                    foreach ($transaksi->where("id_transaksi", $order["id_transaksi"])->findAll() as $harga) {
                        $transaksi->update(["id_transaksi" => $harga["id_transaksi"]], ["total" => $harga["harga_barang"] * $order["qty"] + $harga["harga_layanan"]]);
                    }
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

            return view('templates/header', ["title" => "Transaksi"]) . view('templates/menu') . view('admin/transaksi/transaksi', ["transaksi" => $data_transaksi]);
        } else {
            return redirect('/');
        }
    }

    public function createForm()
    {

        $pelanggan = new DataPelangganModel();
        $barang = new DataBarangModel();
        $layanan = new DataLayananModel();

        $data = [
            "pelanggan" => $pelanggan->findAll(),
            "barang" => $barang->findAll(),
            "layanan" => $layanan->findAll()
        ];
        return view('templates/header', ["title" => "Transaksi"]) . view('templates/menu') . view('admin/transaksi/add_transaksi', $data);
    }

    public function create()
    {
        $transaksi = new DataTransaksiModel();
        $pks = new PerjanjianKerjasamaModel();
        $pelanggan = new DataPelangganModel();
        $jumlah_barang = $this->request->getPost("jumlah_barang");
        $jumlah_layanan = $this->request->getPost("jumlah_layanan");

        $date = new DateTime("now");
        if ($jumlah_barang >= $jumlah_layanan) {
            for ($i = 0; $i < $jumlah_barang; $i++) {
                $data = [
                    "id_transaksi" => uniqid(),
                    "id_pelanggan" => $this->request->getPost("pelanggan"),
                    "kode_barang" => $this->request->getPost("barang_order" . $i),
                    "qty" => $this->request->getPost("qty" . $i),
                    "kode_layanan" => $this->request->getPost("layanan_order" . $i),
                    "tanggal" => $date->format('Y-m-d'),
                    "status" => 2
                ];

                $transaksi->insert($data);
            }
        } else {
            for ($i = 0; $i < $jumlah_layanan; $i++) {
                $data = [
                    "id_transaksi" => uniqid(),
                    "id_pelanggan" => $this->request->getPost("pelanggan"),
                    "kode_barang" => $this->request->getPost("barang_order" . $i),
                    "qty" => $this->request->getPost("qty" . $i),
                    "kode_layanan" => $this->request->getPost("layanan_order" . $i),
                    "tanggal" => $date->format('Y-m-d'),
                    "status" => 2
                ];

                $transaksi->insert($data);
            }
        }

        // print_r($data);
        // die();
        $nama_desa = $pelanggan->where("id_pelanggan", $data["id_pelanggan"])->first()["nama_desa"];
        $data_pks = [
            "id_pks" => uniqid(),
            "nama_desa" => $nama_desa,
            "tanggal" => $data["tanggal"],
            "id_transaksi" => $data["id_transaksi"],
        ];

        $pks->insert($data_pks);
        return redirect()->to('/transaksi');
    }

    public function detail($id, $tanggal)
    {
        $transaksi = new DataTransaksiModel();

        $data = [];
        foreach ($transaksi->where(["data_transaksi.id_pelanggan" => $id, "tanggal" => $tanggal])->findAll() as $order) {
            if ($order["kode_barang"] == NULL) {
                $transaksi->join("data_layanan", "data_layanan.kode_layanan = data_transaksi.kode_layanan", "inner")
                    ->join("data_pelanggan", "data_pelanggan.id_pelanggan = data_transaksi.id_pelanggan", "inner");

                foreach ($transaksi->where(["data_transaksi.id_transaksi" => $order["id_transaksi"], "tanggal" => $tanggal])->findAll() as $detail) {
                    $data2 = [
                        "id_transaksi" => $detail["id_transaksi"],
                        "id_pelanggan" => $detail["id_pelanggan"],
                        "nama_pelanggan" => $detail["nama_pelanggan"],
                        "alamat" => $detail["alamat"],
                        "no_telp" => $detail["no_telp"],
                        "nama_barang" => NULL,
                        "harga_barang" => NULL,
                        "qty" => NULL,
                        "nama_layanan" => $detail["nama_layanan"],
                        "harga_layanan" => $detail["harga_layanan"],
                        "total" => $detail["total"],
                        "tanggal" => $detail["tanggal"]
                    ];

                    array_push($data, $data2);
                }
            } else if ($order["kode_layanan"] == NULL) {
                $transaksi->join("data_barang", "data_barang.kode_barang = data_transaksi.kode_barang", "inner")
                    ->join("data_pelanggan", "data_pelanggan.id_pelanggan = data_transaksi.id_pelanggan", "inner");

                foreach ($transaksi->where(["data_transaksi.id_transaksi" => $order["id_transaksi"], "tanggal" => $tanggal])->findAll() as $detail) {
                    $data2 = [
                        "id_transaksi" => $detail["id_transaksi"],
                        "id_pelanggan" => $detail["id_pelanggan"],
                        "nama_pelanggan" => $detail["nama_pelanggan"],
                        "alamat" => $detail["alamat"],
                        "no_telp" => $detail["no_telp"],
                        "nama_barang" => $detail["nama_barang"],
                        "harga_barang" => $detail["harga_barang"],
                        "qty" => $detail["qty"],
                        "nama_layanan" => NULL,
                        "harga_layanan" => NULL,
                        "total" => $detail["total"],
                        "tanggal" => $detail["tanggal"]
                    ];

                    array_push($data, $data2);
                }
            } else {
                $transaksi->join("data_barang", "data_barang.kode_barang = data_transaksi.kode_barang", "inner")
                    ->join("data_layanan", "data_layanan.kode_layanan = data_transaksi.kode_layanan", "inner")
                    ->join("data_pelanggan", "data_pelanggan.id_pelanggan = data_transaksi.id_pelanggan", "inner");

                foreach ($transaksi->where(["data_transaksi.id_transaksi" => $order["id_transaksi"], "tanggal" => $tanggal])->findAll() as $detail) {
                    $data2 = [
                        "id_transaksi" => $detail["id_transaksi"],
                        "id_pelanggan" => $detail["id_pelanggan"],
                        "nama_pelanggan" => $detail["nama_pelanggan"],
                        "alamat" => $detail["alamat"],
                        "no_telp" => $detail["no_telp"],
                        "nama_barang" => $detail["nama_barang"],
                        "harga_barang" => $detail["harga_barang"],
                        "qty" => $detail["qty"],
                        "nama_layanan" => $detail["nama_layanan"],
                        "harga_layanan" => $detail["harga_layanan"],
                        "total" => $detail["total"],
                        "tanggal" => $detail["tanggal"]
                    ];

                    array_push($data, $data2);
                }
            }
        }

        if ($data == NULL) {
            return redirect()->to("/transaksi");
        } else {
            return view('templates/header', ["title" => "Transaksi"]) . view('templates/menu') . view('admin/transaksi/detail_transaksi', ["transaksi" => $data]);
        }
    }

    public function approve($id, $tanggal)
    {
        $transaksi = new DataTransaksiModel();

        foreach ($transaksi->where(["id_pelanggan" => $id, "tanggal" => $tanggal])->findAll() as $order) {
            $transaksi->update(["id_transaksi" => $order["id_transaksi"]], ["status" => 1]);
        }

        return redirect()->to('/transaksi');
    }

    public function pending($id, $tanggal)
    {
        $transaksi = new DataTransaksiModel();

        foreach ($transaksi->where(["id_pelanggan" => $id, "tanggal" => $tanggal])->findAll() as $order) {
            $transaksi->update(["id_transaksi" => $order["id_transaksi"]], ["status" => 2]);
        }

        return redirect()->to('/transaksi');
    }

    public function cancel($id, $tanggal)
    {
        $transaksi = new DataTransaksiModel();

        foreach ($transaksi->where(["id_pelanggan" => $id, "tanggal" => $tanggal])->findAll() as $order) {
            $transaksi->update(["id_transaksi" => $order["id_transaksi"]], ["status" => 0]);
        }

        return redirect()->to('/transaksi');
    }

    public function editForm($id_transaksi)
    {
        $pelanggan = new DataPelangganModel();
        $transaksi = new DataTransaksiModel();
        $barang = new DataBarangModel();
        $layanan = new DataLayananModel();

        $data = [
            "pelanggan" => $pelanggan->findAll(),
            "transaksi" => $transaksi->find($id_transaksi),
            "barang" => $barang->findAll(),
            "layanan" => $layanan->findAll()
        ];

        return view('templates/header', ["title" => "Transaksi"]) . view('templates/menu') . view('admin/transaksi/edit_transaksi', $data);
    }
    public function edit()
    {
        $transaksi = new DataTransaksiModel();
        $barang = new DataBarangModel();
        $layanan = new DataLayananModel();

        if ($this->request->getPost("barang") == NULL) {
            $total = $layanan->select("harga_layanan")->find($this->request->getPost("layanan"))["harga_layanan"];
        } else if ($this->request->getPost("layanan") ==  NULL) {
            $total = $barang->select("harga_barang")->find($this->request->getPost("barang"))["harga_barang"] * $this->request->getPost("qty");
        } else {
            $total = ($barang->select("harga_barang")->find($this->request->getPost("barang"))["harga_barang"] * $this->request->getPost("qty")
                + $layanan->select("harga_layanan")->find($this->request->getPost("layanan"))["harga_layanan"]);
        }

        $transaksi->update(
            ["id_transaksi" => $this->request->getPost("id_transaksi")],
            [
                "kode_barang" => $this->request->getPost("barang"),
                "kode_layanan" => $this->request->getPost("layanan"),
                "qty" => $this->request->getPost("qty"),
                "total" => $total
            ]
        );

        $id = $this->request->getPost("pelanggan");
        $tanggal = $this->request->getPost("tanggal");


        return redirect()->to('/transaksi/detail/' . $id . '/' . $tanggal);
    }

    public function delete($id_transaksi, $id_pelanggan, $tanggal)
    {
        $transaksi = new DataTransaksiModel();

        $transaksi->delete($id_transaksi);

        return redirect()->to('/transaksi/detail/' . $id_pelanggan . '/' . $tanggal);
    }
}
