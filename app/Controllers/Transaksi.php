<?php

namespace App\Controllers;

use App\Models\DataPelangganModel;
use App\Controllers\BaseController;
use App\Models\DataBarangModel;
use App\Models\DataTransaksiModel;
use App\Models\DataLayananModel;
use DateTime;
use Kint\Zval\Value;

class Transaksi extends BaseController
{
    public function index()
    {
        $transaksi = new DataTransaksiModel();


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

        return view('templates/header', ["title" => "Transaksi"]) . view('templates/menu') . view('admin/transaksi', ["transaksi" => $data_transaksi]);
    }

    public function cards()
    {
        return view('cards');
    }
    public function modals()
    {
        return view('modals');
    }
    public function charts()
    {
        return view('charts');
    }

    public function form()
    {
        return view('templates/header', ["title" => "Transaksi"]) . view('templates/menu') . view('forms');
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
        return view('templates/header', ["title" => "Transaksi"]) . view('templates/menu') . view('admin/add_transaksi', $data);
    }

    public function create()
    {
        $transaksi = new DataTransaksiModel();
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
        return redirect()->to('/transaksi');
    }

    public function detail($id, $tanggal)
    {
        $transaksi = new DataTransaksiModel();

        $data = ["transaksi" => $transaksi->join("data_pelanggan", "data_pelanggan.id_pelanggan = data_transaksi.id_pelanggan", "inner")->where(["data_transaksi.id_pelanggan" => $id, "tanggal" => $tanggal])->findAll()];

        return view('templates/header', ["title" => "Transaksi"]) . view('templates/menu') . view('admin/detail_transaksi', $data);
    }
}
