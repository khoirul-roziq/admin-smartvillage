<?php

namespace App\Controllers;

use DateTime;
use Kint\Zval\Value;
use App\Models\ProfilModel;
use App\Models\DataBarangModel;
use App\Models\BarangOrderModel;
use App\Models\DataLayananModel;
use App\Models\LayananOrderModel;
use App\Models\DataPelangganModel;
use App\Models\DataTransaksiModel;
use App\Controllers\BaseController;
use App\Models\PerjanjianKerjasamaModel;

class Transaksi extends BaseController
{
    public function index()
    {
        $transaksi = new DataTransaksiModel();

        if ($this->session->has('username')) {
            $id_transaksi = $transaksi->select("data_transaksi.id_transaksi")->orderBy("id_transaksi")->findAll();
            $transaksi->join("layanan_order", "layanan_order.id_transaksi=data_transaksi.id_transaksi", "left")
                ->join("barang_order", "barang_order.id_transaksi=data_transaksi.id_transaksi", "left");

            foreach ($transaksi->orderBy("data_transaksi.id_transaksi")->findAll() as $index => $order) {
                if ($order["kode_barang"] == NULL && $order["kode_layanan"] != NULL) {
                    $transaksi->update(["id_transaksi" => $id_transaksi[$index]["id_transaksi"]], ["total" => $order["harga_layanan"]]);
                } else if ($order["kode_layanan"] == NULL && $order["kode_barang"] != NULL) {
                    $transaksi->update(["id_transaksi" => $id_transaksi[$index]["id_transaksi"]], ["total" => $order["harga_barang"] * $order["qty"]]);
                } else if ($order["kode_barang"] == NULL && $order["kode_layanan"] == NULL) {
                    $transaksi->update(["id_transaksi" => $id_transaksi[$index]["id_transaksi"]], ["total" => 0]);
                } else {
                    $transaksi->update(["id_transaksi" => $id_transaksi[$index]["id_transaksi"]], ["total" => $order["harga_barang"] * $order["qty"] + $order["harga_layanan"]]);
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

                return view('templates/header', ["title" => "Transaksi"]) . view('templates/menu') . view('admin/transaksi/transaksi', ["transaksi" => $data_transaksi]);
            } else {
                return view('templates/header', ["title" => "Transaksi"]) . view('templates/menu') . view('admin/transaksi/transaksi', ["transaksi" => $transaksi->findAll()]);
            }
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

    public function createFormNew()
    {

        $pelanggan = new DataPelangganModel();
        $barang = new DataBarangModel();
        $layanan = new DataLayananModel();

        $data = [
            "pelanggan" => $pelanggan->findAll(),
            "barang" => $barang->findAll(),
            "layanan" => $layanan->findAll()
        ];
        return view('templates/header', ["title" => "Transaksi"]) . view('templates/menu') . view('admin/transaksi/add_transaksi_new', $data);
    }

    public function create()
    {
        $transaksi = new DataTransaksiModel();
        $pks = new PerjanjianKerjasamaModel();
        $pelanggan = new DataPelangganModel();
        $barang = new DataBarangModel();
        $layanan = new DataLayananModel();
        $barang_order = new BarangOrderModel();
        $layanan_order = new LayananOrderModel();
        $profil = new ProfilModel();
        $jumlah_barang = $this->request->getPost("jumlah_barang");
        $jumlah_layanan = $this->request->getPost("jumlah_layanan");
        $id_pelanggan = $this->request->getPost("pelanggan");
        $kode_nota = $profil->first()["kode_nota"];
        $date = new DateTime("now");
        if ($jumlah_barang >= $jumlah_layanan) {
            for ($i = 0; $i < $jumlah_barang; $i++) {
                $nota = $transaksi->where("kode_nota", $kode_nota)->findAll();
                foreach ($nota as $n) {
                    $nota = $n;
                }
                print_r($nota);
                if ($nota != NULL) {
                    $nomor_nota = (int)$nota["nomor_nota"];
                    if ($nomor_nota != NULL && $nota["kode_nota"] == $kode_nota && $nota["id_pelanggan"] == $id_pelanggan && $nota["tanggal"] == $date->format('Y-m-d')) {
                        if ($nomor_nota < 10) {
                            $nomor_nota = "000" . $nomor_nota;
                        } else if ($nomor_nota < 100) {
                            $nomor_nota = "00" . $nomor_nota;
                        } else if ($nomor_nota < 1000) {
                            $nomor_nota = "0" . $nomor_nota;
                        }
                    } else if ($nomor_nota != NULL && $nota["kode_nota"] == $kode_nota) {
                        $nomor_nota++;
                        if ($nomor_nota < 10) {
                            $nomor_nota = "000" . $nomor_nota;
                        } else if ($nomor_nota < 100) {
                            $nomor_nota = "00" . $nomor_nota;
                        } else if ($nomor_nota < 1000) {
                            $nomor_nota = "0" . $nomor_nota;
                        }
                    } else {
                        $nomor_nota = "0001";
                    }
                } else {
                    $nomor_nota = "0001";
                }
                $temp_status = $transaksi->where(["id_pelanggan" => $this->request->getPost("pelanggan"), "tanggal" => $date->format('Y-m-d')])->first();
                if ($temp_status != NULL) {
                    if ($temp_status["status"] == 1) {
                        $status = 1;
                    } else if ($temp_status["status"] == 0) {
                        $status = 0;
                    } else {
                        $status = 2;
                    }
                } else {
                    $status = 2;
                }

                $data = [
                    "id_transaksi" => uniqid(),
                    "id_pelanggan" => $this->request->getPost("pelanggan"),
                    "tanggal" => $date->format('Y-m-d'),
                    "status" => $status,
                    "kode_nota" => $kode_nota,
                    "nomor_nota" => $nomor_nota
                ];

                $transaksi->insert($data);

                $nama_barang = NULL;
                $harga_barang = NULL;
                if ($this->request->getPost("barang_order" . $i) != NULL) {
                    $nama_barang = $barang->select('nama_barang')
                        ->where("kode_barang", $this->request->getPost("barang_order" . $i))
                        ->first()['nama_barang'];
                    $harga_barang = $barang->select('harga_barang')
                        ->where("kode_barang", $this->request->getPost("barang_order" . $i))
                        ->first()['harga_barang'];
                    $order = [
                        "id_barang" => uniqid(),
                        "kode_barang" => $this->request->getPost("barang_order" . $i),
                        "nama_barang" => $nama_barang,
                        "harga_barang" => $harga_barang,
                        "qty" => $this->request->getPost("qty" . $i),
                        "id_transaksi" => $data['id_transaksi']
                    ];

                    $barang_order->insert($order);
                }

                $nama_layanan = NULL;
                $harga_layanan = NULL;
                if ($this->request->getPost("layanan_order" . $i) != NULL) {
                    $nama_layanan = $layanan->select('nama_layanan')
                        ->where("kode_layanan", $this->request->getPost("layanan_order" . $i))
                        ->first()['nama_layanan'];
                    $harga_layanan = $layanan->select('harga_layanan')
                        ->where("kode_layanan", $this->request->getPost("layanan_order" . $i))
                        ->first()['harga_layanan'];
                    $order = [
                        "id_layanan" => uniqid(),
                        "kode_layanan" => $this->request->getPost("layanan_order" . $i),
                        "nama_layanan" => $nama_layanan,
                        "harga_layanan" => $harga_layanan,
                        "id_transaksi" => $data['id_transaksi']
                    ];
                    $layanan_order->insert($order);
                }

                $nama_desa = $pelanggan->where("id_pelanggan", $data["id_pelanggan"])->first()["nama_desa"];
                $data_pks = [
                    "id_pks" => uniqid(),
                    "nama_desa" => $nama_desa,
                    "tanggal" => $data["tanggal"],
                    "id_transaksi" => $data["id_transaksi"],
                ];

                $pks->insert($data_pks);
            }
        } else {
            for ($i = 0; $i < $jumlah_layanan; $i++) {
                $nota = $transaksi->where("kode_nota", $kode_nota)->findAll();
                foreach ($nota as $n) {
                    $nota = $n;
                }
                print_r($nota);
                if ($nota != NULL) {
                    $nomor_nota = (int)$nota["nomor_nota"];
                    if ($nomor_nota != NULL && $nota["kode_nota"] == $kode_nota && $nota["id_pelanggan"] == $id_pelanggan && $nota["tanggal"] == $date->format('Y-m-d')) {
                        if ($nomor_nota < 10) {
                            $nomor_nota = "000" . $nomor_nota;
                        } else if ($nomor_nota < 100) {
                            $nomor_nota = "00" . $nomor_nota;
                        } else if ($nomor_nota < 1000) {
                            $nomor_nota = "0" . $nomor_nota;
                        }
                    } else if ($nomor_nota != NULL && $nota["kode_nota"] == $kode_nota) {
                        $nomor_nota++;
                        if ($nomor_nota < 10) {
                            $nomor_nota = "000" . $nomor_nota;
                        } else if ($nomor_nota < 100) {
                            $nomor_nota = "00" . $nomor_nota;
                        } else if ($nomor_nota < 1000) {
                            $nomor_nota = "0" . $nomor_nota;
                        }
                    } else {
                        $nomor_nota = "0001";
                    }
                } else {
                    $nomor_nota = "0001";
                }
                $temp_status = $transaksi->where(["id_pelanggan" => $this->request->getPost("pelanggan"), "tanggal" => $date->format('Y-m-d')])->first();
                if ($temp_status != NULL) {
                    if ($temp_status["status"] == 1) {
                        $status = 1;
                    } else if ($temp_status["status"] == 0) {
                        $status = 0;
                    } else {
                        $status = 2;
                    }
                } else {
                    $status = 2;
                }

                $data = [
                    "id_transaksi" => uniqid(),
                    "id_pelanggan" => $this->request->getPost("pelanggan"),
                    "tanggal" => $date->format('Y-m-d'),
                    "status" => 2,
                    "kode_nota" => $kode_nota,
                    "nomor_nota" => $nomor_nota
                ];
                $transaksi->insert($data);

                $nama_barang = NULL;
                $harga_barang = NULL;
                if ($this->request->getPost("barang_order" . $i) != NULL) {
                    $nama_barang = $barang->select('nama_barang')
                        ->where("kode_barang", $this->request->getPost("barang_order" . $i))
                        ->first()['nama_barang'];
                    $harga_barang = $barang->select('harga_barang')
                        ->where("kode_barang", $this->request->getPost("barang_order" . $i))
                        ->first()['harga_barang'];
                    $order = [
                        "id_barang" => uniqid(),
                        "kode_barang" => $this->request->getPost("barang_order" . $i),
                        "nama_barang" => $nama_barang,
                        "harga_barang" => $harga_barang,
                        "qty" => $this->request->getPost("qty" . $i),
                        "id_transaksi" => $data['id_transaksi']
                    ];
                    $barang_order->insert($order);
                }

                $nama_layanan = NULL;
                $harga_layanan = NULL;
                if ($this->request->getPost("layanan_order" . $i) != NULL) {
                    $nama_layanan = $layanan->select('nama_layanan')
                        ->where("kode_layanan", $this->request->getPost("layanan_order" . $i))
                        ->first()['nama_layanan'];
                    $harga_layanan = $layanan->select('harga_layanan')
                        ->where("kode_layanan", $this->request->getPost("layanan_order" . $i))
                        ->first()['harga_layanan'];
                    $order = [
                        "id_layanan" => uniqid(),
                        "kode_layanan" => $this->request->getPost("layanan_order" . $i),
                        "nama_layanan" => $nama_layanan,
                        "harga_layanan" => $harga_layanan,
                        "id_transaksi" => $data['id_transaksi']
                    ];
                    $layanan_order->insert($order);
                }

                $nama_desa = $pelanggan->where("id_pelanggan", $data["id_pelanggan"])->first()["nama_desa"];
                $data_pks = [
                    "id_pks" => uniqid(),
                    "nama_desa" => $nama_desa,
                    "tanggal" => $data["tanggal"],
                    "id_transaksi" => $data["id_transaksi"],
                ];

                $pks->insert($data_pks);
            }
        }

        return redirect()->to('/transaksi');
    }

    public function createNew()
    {
        $transaksi = new DataTransaksiModel();
        $pks = new PerjanjianKerjasamaModel();
        $pelanggan = new DataPelangganModel();
        $barang = new DataBarangModel();
        $layanan = new DataLayananModel();
        $profil = new ProfilModel();
        $barang_order = new BarangOrderModel();
        $layanan_order = new LayananOrderModel();
        $jumlah_barang = $this->request->getPost("jumlah_barang");
        $jumlah_layanan = $this->request->getPost("jumlah_layanan");
        $kode_nota = $profil->first()["kode_nota"];
        $id_pelanggan = $this->request->getPost("id_pelanggan");

        $dataPelanggan = [
            'id_pelanggan' => uniqid(),
            'nama_pelanggan' => $this->request->getPost("namaPelanggan"),
            'nama_desa'  => $this->request->getPost("namaDesa"),
            'no_telp' => $this->request->getPost("telepon"),
            'email' => $this->request->getPost("email"),
            'alamat' => $this->request->getPost("alamat"),
        ];

        $date = new DateTime("now");
        if ($jumlah_barang >= $jumlah_layanan) {
            for ($i = 0; $i < $jumlah_barang; $i++) {
                $nota = $transaksi->last();
                $nomor_nota = (int)$nota["nomor_nota"];
                if ($nomor_nota != NULL && $nota["kode_nota"] && $nota["id_pelanggan"] == $id_pelanggan && $nota["tanggal"] == $date->format('Y-m-d')) {
                    $nomor_nota++;
                    if ($nomor_nota < 10) {
                        $nomor_nota = "000" . $nomor_nota;
                    } else if ($nomor_nota < 100) {
                        $nomor_nota = "00" . $nomor_nota;
                    } else if ($nomor_nota < 1000) {
                        $nomor_nota = "0" . $nomor_nota;
                    }
                } else {
                    $nomor_nota = "0001";
                }
                $temp_status = $transaksi->where(["id_pelanggan" => $this->request->getPost("pelanggan"), "tanggal" => $date->format('Y-m-d')])->first();
                if ($temp_status != NULL) {
                    if ($temp_status["status"] == 1) {
                        $status = 1;
                    } else if ($temp_status["status"] == 0) {
                        $status = 0;
                    } else {
                        $status = 2;
                    }
                } else {
                    $status = 2;
                }

                $data = [
                    "id_transaksi" => uniqid(),
                    "id_pelanggan" => $this->request->getPost("pelanggan"),
                    "tanggal" => $date->format('Y-m-d'),
                    "status" => $status
                ];
                $transaksi->insert($data);

                $nama_barang = NULL;
                $harga_barang = NULL;
                if ($this->request->getPost("barang_order" . $i) != NULL) {
                    $nama_barang = $barang->select('nama_barang')
                        ->where("kode_barang", $this->request->getPost("barang_order" . $i))
                        ->first()['nama_barang'];
                    $harga_barang = $barang->select('harga_barang')
                        ->where("kode_barang", $this->request->getPost("barang_order" . $i))
                        ->first()['harga_barang'];
                    $order = [
                        "id_barang" => uniqid(),
                        "kode_barang" => $this->request->getPost("barang_order" . $i),
                        "nama_barang" => $nama_barang,
                        "harga_barang" => $harga_barang,
                        "qty" => $this->request->getPost("qty" . $i),
                        "id_transaksi" => $data['id_transaksi']
                    ];

                    $barang_order->insert($order);
                }

                $nama_layanan = NULL;
                $harga_layanan = NULL;
                if ($this->request->getPost("layanan_order" . $i) != NULL) {
                    $nama_layanan = $layanan->select('nama_layanan')
                        ->where("kode_layanan", $this->request->getPost("layanan_order" . $i))
                        ->first()['nama_layanan'];
                    $harga_layanan = $layanan->select('harga_layanan')
                        ->where("kode_layanan", $this->request->getPost("layanan_order" . $i))
                        ->first()['harga_layanan'];
                    $order = [
                        "id_layanan" => uniqid(),
                        "kode_layanan" => $this->request->getPost("layanan_order" . $i),
                        "nama_layanan" => $nama_layanan,
                        "harga_layanan" => $harga_layanan,
                        "id_transaksi" => $data['id_transaksi']
                    ];
                    $layanan_order->insert($order);
                }

                $nama_desa = $pelanggan->where("id_pelanggan", $data["id_pelanggan"])->first()["nama_desa"];
                $data_pks = [
                    "id_pks" => uniqid(),
                    "nama_desa" => $nama_desa,
                    "tanggal" => $data["tanggal"],
                    "id_transaksi" => $data["id_transaksi"],
                ];

                $pks->insert($data_pks);
            }
        } else {
            for ($i = 0; $i < $jumlah_layanan; $i++) {
                $nota = $transaksi->last();
                $nomor_nota = (int)$nota["nomor_nota"];
                if ($nomor_nota != NULL && $nota["kode_nota"] && $nota["id_pelanggan"] == $id_pelanggan && $nota["tanggal"] == $date->format('Y-m-d')) {
                    $nomor_nota++;
                    if ($nomor_nota < 10) {
                        $nomor_nota = "000" . $nomor_nota;
                    } else if ($nomor_nota < 100) {
                        $nomor_nota = "00" . $nomor_nota;
                    } else if ($nomor_nota < 1000) {
                        $nomor_nota = "0" . $nomor_nota;
                    }
                } else {
                    $nomor_nota = "0001";
                }
                $temp_status = $transaksi->where(["id_pelanggan" => $this->request->getPost("pelanggan"), "tanggal" => $date->format('Y-m-d')])->first();
                if ($temp_status != NULL) {
                    if ($temp_status["status"] == 1) {
                        $status = 1;
                    } else if ($temp_status["status"] == 0) {
                        $status = 0;
                    } else {
                        $status = 2;
                    }
                } else {
                    $status = 2;
                }

                $data = [
                    "id_transaksi" => uniqid(),
                    "id_pelanggan" => $this->request->getPost("pelanggan"),
                    "tanggal" => $date->format('Y-m-d'),
                    "status" => 2
                ];
                $transaksi->insert($data);

                $nama_barang = NULL;
                $harga_barang = NULL;
                if ($this->request->getPost("barang_order" . $i) != NULL) {
                    $nama_barang = $barang->select('nama_barang')
                        ->where("kode_barang", $this->request->getPost("barang_order" . $i))
                        ->first()['nama_barang'];
                    $harga_barang = $barang->select('harga_barang')
                        ->where("kode_barang", $this->request->getPost("barang_order" . $i))
                        ->first()['harga_barang'];
                    $order = [
                        "id_barang" => uniqid(),
                        "kode_barang" => $this->request->getPost("barang_order" . $i),
                        "nama_barang" => $nama_barang,
                        "harga_barang" => $harga_barang,
                        "qty" => $this->request->getPost("qty" . $i),
                        "id_transaksi" => $data['id_transaksi']
                    ];
                    $barang_order->insert($order);
                }

                $nama_layanan = NULL;
                $harga_layanan = NULL;
                if ($this->request->getPost("layanan_order" . $i) != NULL) {
                    $nama_layanan = $layanan->select('nama_layanan')
                        ->where("kode_layanan", $this->request->getPost("layanan_order" . $i))
                        ->first()['nama_layanan'];
                    $harga_layanan = $layanan->select('harga_layanan')
                        ->where("kode_layanan", $this->request->getPost("layanan_order" . $i))
                        ->first()['harga_layanan'];
                    $order = [
                        "id_layanan" => uniqid(),
                        "kode_layanan" => $this->request->getPost("layanan_order" . $i),
                        "nama_layanan" => $nama_layanan,
                        "harga_layanan" => $harga_layanan,
                        "id_transaksi" => $data['id_transaksi']
                    ];
                    $layanan_order->insert($order);
                }

                $nama_desa = $pelanggan->where("id_pelanggan", $data["id_pelanggan"])->first()["nama_desa"];
                $data_pks = [
                    "id_pks" => uniqid(),
                    "nama_desa" => $nama_desa,
                    "tanggal" => $data["tanggal"],
                    "id_transaksi" => $data["id_transaksi"],
                ];

                $pks->insert($data_pks);
            }
        }

        return redirect()->to('/transaksi');
    }

    public function detail($id, $tanggal)
    {
        $transaksi = new DataTransaksiModel();
        $id_transaksi = $transaksi->select("data_transaksi.id_transaksi")->where(["data_transaksi.id_pelanggan" => $id, "tanggal" => $tanggal])->orderBy("data_transaksi.id_transaksi")->findAll();
        $transaksi->join("layanan_order", "layanan_order.id_transaksi = data_transaksi.id_transaksi", "left")
            ->join("data_pelanggan", "data_pelanggan.id_pelanggan = data_transaksi.id_pelanggan", "left")
            ->join("barang_order", "barang_order.id_transaksi = data_transaksi.id_transaksi", "left");

        $data = [];
        foreach ($transaksi->where(["data_transaksi.id_pelanggan" => $id, "tanggal" => $tanggal])->orderBy("data_transaksi.id_transaksi")->findAll() as $index => $order) {
            if ($order["kode_barang"] == NULL) {
                $data2 = [
                    "id_barang" => $order["id_barang"],
                    "id_layanan" => $order["id_layanan"],
                    "id_transaksi" => $id_transaksi[$index]["id_transaksi"],
                    "id_pelanggan" => $order["id_pelanggan"],
                    "nama_pelanggan" => $order["nama_pelanggan"],
                    "alamat" => $order["alamat"],
                    "no_telp" => $order["no_telp"],
                    "nama_barang" => NULL,
                    "harga_barang" => NULL,
                    "qty" => NULL,
                    "nama_layanan" => $order["nama_layanan"],
                    "harga_layanan" => $order["harga_layanan"],
                    "total" => $order["total"],
                    "tanggal" => $order["tanggal"]
                ];

                array_push($data, $data2);
            } else if ($order["kode_layanan"] == NULL) {
                $data2 = [
                    "id_barang" => $order["id_barang"],
                    "id_layanan" => $order["id_layanan"],
                    "id_transaksi" => $id_transaksi[$index]["id_transaksi"],
                    "id_pelanggan" => $order["id_pelanggan"],
                    "nama_pelanggan" => $order["nama_pelanggan"],
                    "alamat" => $order["alamat"],
                    "no_telp" => $order["no_telp"],
                    "nama_barang" => $order["nama_barang"],
                    "harga_barang" => $order["harga_barang"],
                    "qty" => $order["qty"],
                    "nama_layanan" => NULL,
                    "harga_layanan" => NULL,
                    "total" => $order["total"],
                    "tanggal" => $order["tanggal"]
                ];

                array_push($data, $data2);
            } else {
                $data2 = [
                    "id_barang" => $order["id_barang"],
                    "id_layanan" => $order["id_layanan"],
                    "id_transaksi" => $id_transaksi[$index]["id_transaksi"],
                    "id_pelanggan" => $order["id_pelanggan"],
                    "nama_pelanggan" => $order["nama_pelanggan"],
                    "alamat" => $order["alamat"],
                    "no_telp" => $order["no_telp"],
                    "nama_barang" => $order["nama_barang"],
                    "harga_barang" => $order["harga_barang"],
                    "qty" => $order["qty"],
                    "nama_layanan" => $order["nama_layanan"],
                    "harga_layanan" => $order["harga_layanan"],
                    "total" => $order["total"],
                    "tanggal" => $order["tanggal"]
                ];

                array_push($data, $data2);
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

    public function editBarangForm($id_transaksi)
    {
        $pelanggan = new DataPelangganModel();
        $transaksi = new DataTransaksiModel();
        $barang = new DataBarangModel();
        $layanan = new DataLayananModel();

        $data = [
            "pelanggan" => $pelanggan->findAll(),
            "transaksi" => $transaksi->join("layanan_order", "layanan_order.id_transaksi= data_transaksi.id_transaksi", "left")
                ->join("barang_order", "barang_order.id_transaksi= data_transaksi.id_transaksi", "left")->find($id_transaksi),
            "barang" => $barang->findAll(),
            "layanan" => $layanan->findAll()
        ];

        return view('templates/header', ["title" => "Transaksi"]) . view('templates/menu') . view('admin/transaksi/edit_barang', $data);
    }

    public function editLayananForm($id_transaksi)
    {
        $pelanggan = new DataPelangganModel();
        $transaksi = new DataTransaksiModel();
        $barang = new DataBarangModel();
        $layanan = new DataLayananModel();

        $data = [
            "pelanggan" => $pelanggan->findAll(),
            "transaksi" => $transaksi->join("layanan_order", "layanan_order.id_transaksi= data_transaksi.id_transaksi", "left")
                ->join("barang_order", "barang_order.id_transaksi= data_transaksi.id_transaksi", "left")->find($id_transaksi),
            "barang" => $barang->findAll(),
            "layanan" => $layanan->findAll()
        ];

        return view('templates/header', ["title" => "Transaksi"]) . view('templates/menu') . view('admin/transaksi/edit_layanan', $data);
    }
    public function editBarang()
    {
        $transaksi = new DataTransaksiModel();
        $barang_order = new BarangOrderModel();
        $barang = new DataBarangModel();
        $id_transaksi = $this->request->getPost("id_transaksi");
        $data = $transaksi->join("layanan_order", "layanan_order.id_transaksi= data_transaksi.id_transaksi", "left")->where("data_transaksi.id_transaksi", $id_transaksi)->first();

        if ($data["kode_layanan"] != NULL) {
            $total = $data["harga_layanan"] + ($barang->find($this->request->getPost("barang"))["harga_barang"] * $this->request->getPost("qty"));
        } else {
            $total = ($barang->find($this->request->getPost("barang"))["harga_barang"] * $this->request->getPost("qty"));
        }

        $barang_order->update(
            ["id_barang" => $this->request->getPost("id_barang")],
            [
                "kode_barang" => $this->request->getPost("barang"),
                "nama_barang" => $barang->find($this->request->getPost("barang"))["nama_barang"],
                "harga_barang" => $barang->find($this->request->getPost("barang"))["harga_barang"],
                "qty" => $this->request->getPost("qty")
            ]
        );

        $transaksi->update(
            ["id_transaksi" => $this->request->getPost("id_transaksi")],
            [
                "total" => $total
            ]
        );

        $id = $this->request->getPost("pelanggan");
        $tanggal = $this->request->getPost("tanggal");


        return redirect()->to('/transaksi/detail/' . $id . '/' . $tanggal);
    }

    public function editLayanan()
    {
        $transaksi = new DataTransaksiModel();
        $layanan_order = new LayananOrderModel();
        $layanan = new DataLayananModel();
        $id_transaksi = $this->request->getPost("id_transaksi");
        $data = $transaksi->join("barang_order", "barang_order.id_transaksi= data_transaksi.id_transaksi", "left")->where("data_transaksi.id_transaksi", $id_transaksi)->first();

        if ($data["kode_barang"] != NULL) {
            $total = $data["harga_barang"] * $data["qty"] + ($layanan->find($this->request->getPost("layanan"))["harga_layanan"]);
        } else {
            $total = ($layanan->find($this->request->getPost("layanan"))["harga_layanan"]);
        }

        $layanan_order->update(
            ["id_layanan" => $this->request->getPost("id_layanan")],
            [
                "kode_layanan" => $this->request->getPost("layanan"),
                "nama_layanan" => $layanan->find($this->request->getPost("layanan"))["nama_layanan"],
                "harga_layanan" => $layanan->find($this->request->getPost("layanan"))["harga_layanan"],
            ]
        );

        $transaksi->update(
            ["id_transaksi" => $this->request->getPost("id_transaksi")],
            [
                "total" => $total
            ]
        );

        $id = $this->request->getPost("pelanggan");
        $tanggal = $this->request->getPost("tanggal");


        return redirect()->to('/transaksi/detail/' . $id . '/' . $tanggal);
    }

    public function deleteBarang($id_barang, $id_pelanggan, $tanggal)
    {
        $barang_order = new BarangOrderModel();
        $barang_order->delete($id_barang);
        return redirect()->to('/transaksi/detail/' . $id_pelanggan . '/' . $tanggal);
    }

    public function deleteLayanan($id_layanan, $id_pelanggan, $tanggal)
    {
        $layanan_order = new LayananOrderModel();
        $layanan_order->delete($id_layanan);
        return redirect()->to('/transaksi/detail/' . $id_pelanggan . '/' . $tanggal);
    }
    public function deleteTransaksi($id_pelanggan, $tanggal)
    {
        $transaksi = new DataTransaksiModel();
        $transaksi->where(["id_pelanggan" => $id_pelanggan, "tanggal" => $tanggal])->delete();
        return redirect()->to('/transaksi/detail/' . $id_pelanggan . '/' . $tanggal);
    }
}
