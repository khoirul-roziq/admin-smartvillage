<?php

namespace App\Controllers;

use App\Models\DataPelangganModel;
use App\Models\UserModel;
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
    public function download($id, $tanggal)
    {
        $transaksi = new DataTransaksiModel();
        $user = new UserModel();
        $id_transaksi = $transaksi->select("data_transaksi.id_transaksi")->where(["data_transaksi.id_pelanggan" => $id, "tanggal" => $tanggal])->orderBy("data_transaksi.id_transaksi")->findAll();
        $transaksi->join("layanan_order", "layanan_order.id_transaksi = data_transaksi.id_transaksi", "left")
            ->join("data_pelanggan", "data_pelanggan.id_pelanggan = data_transaksi.id_pelanggan", "left")
            ->join("barang_order", "barang_order.id_transaksi = data_transaksi.id_transaksi", "left");

        $auth = $user->where(['username' =>  $this->session->get('username')])->first();

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
                    "tanggal" => $order["tanggal"],
                    "kode_barang" => $order["kode_barang"],
                    "kode_layanan" => $order["kode_layanan"],
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
                    "tanggal" => $order["tanggal"],
                    "kode_barang" => $order["kode_barang"],
                    "kode_layanan" => $order["kode_layanan"],
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
                    "tanggal" => $order["tanggal"],
                    "kode_barang" => $order["kode_barang"],
                    "kode_layanan" => $order["kode_layanan"],
                ];

                array_push($data, $data2);
            }
        }

        if ($data == NULL) {
            return redirect()->to("/transaksi");
        } else {
            return view('templates/header', ["title" => "Transaksi"]) . view('nota/download', ["transaksi" => $data, "auth" => $auth]);
        }
    }
}
