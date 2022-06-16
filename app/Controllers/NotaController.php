<?php

namespace App\Controllers;

use App\Models\DataPelangganModel;
use App\Controllers\BaseController;
use App\Models\DataBarangModel;
use App\Models\DataTransaksiModel;
use App\Models\DataLayananModel;
use DateTime;
use Kint\Zval\Value;
use TCPDF;
use Dompdf\Dompdf;
use Dompdf\Options;

class NotaController extends BaseController
{
    public function index($id, $tanggal)
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
                        "tanggal" => $detail["tanggal"],
                        "kode_barang" => $detail["kode_barang"],
                        "kode_layanan" => $detail["kode_layanan"]
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
                        "tanggal" => $detail["tanggal"],
                        "kode_barang" => $detail["kode_barang"],
                        "kode_layanan" => $detail["kode_layanan"]
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
                        "tanggal" => $detail["tanggal"],
                        "kode_barang" => $detail["kode_barang"],
                        "kode_layanan" => $detail["kode_layanan"]
                    ];

                    array_push($data, $data2);
                }
            }
        }
        return view('templates/header', ["title" => "Transaksi"]) . view('templates/menu') . view('nota/index', ["transaksi" => $data]);
    }

    public function download($id, $tanggal)
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
                        "tanggal" => $detail["tanggal"],
                        "kode_barang" => $detail["kode_barang"],
                        "kode_layanan" => $detail["kode_layanan"]
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
                        "tanggal" => $detail["tanggal"],
                        "kode_barang" => $detail["kode_barang"],
                        "kode_layanan" => $detail["kode_layanan"]
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
                        "tanggal" => $detail["tanggal"],
                        "kode_barang" => $detail["kode_barang"],
                        "kode_layanan" => $detail["kode_layanan"]
                    ];

                    array_push($data, $data2);
                }
            }
        }
        return view('templates/header', ["title" => "Transaksi"]) . view('nota/download', ["transaksi" => $data]);

    }
}
