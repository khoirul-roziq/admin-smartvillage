<?php

namespace App\Controllers;

use App\Models\DataPelangganModel;
use App\Controllers\BaseController;
use App\Models\DataBarangModel;
use App\Models\DataTransaksiModel;
use App\Models\DataLayananModel;

class Transaksi extends BaseController
{
    public function index()
    {
        $customers = new DataPelangganModel();
        $transaksi = new DataTransaksiModel();
        $barang = new DataBarangModel();
        $layanan = new DataLayananModel();




        $total = [];
        foreach ($transaksi->findAll() as $order) {
            if ($order["kode_barang"] == NULL) {
                $transaksi->join("data_layanan", "data_layanan.kode_layanan = data_transaksi.kode_layanan", "inner");

                foreach ($transaksi->where("id_transaksi", $order["id_transaksi"])->findAll() as $harga) {
                    array_push($total, $harga["harga_layanan"]);
                }
            } else if ($order["kode_layanan"] == NULL) {
                $transaksi->join("data_barang", "data_barang.kode_barang = data_transaksi.kode_barang", "inner");



                foreach ($transaksi->where("id_transaksi", $order["id_transaksi"])->findAll() as $harga) {
                    array_push($total, $harga["harga_barang"] * $order["qty"]);
                }
            } else {
                $transaksi->join("data_barang", "data_barang.kode_barang = data_transaksi.kode_barang", "inner");
                $transaksi->join("data_layanan", "data_layanan.kode_layanan = data_transaksi.kode_layanan", "inner");


                foreach ($transaksi->where("id_transaksi", $order["id_transaksi"])->findAll() as $harga) {
                    array_push($total, $harga["harga_barang"] * $order["qty"] + $harga["harga_layanan"]);
                }
            }
        }

        // foreach ($transaksi->findAll() as $order) {
        //     $total = 0;
        //     $orders = $transaksi->where("id_pelanggan", $customer["id_pelanggan"])->findAll();


        //     // print_r($orders);
        //     foreach ($orders as $order) {
        //         if ($order["kode_barang"] != NULL) {
        //             foreach ($barang->select("harga_barang")->where("kode_barang", $order["kode_barang"])->first() as $harga_barang) {
        //                 $total += $harga_barang;
        //             }
        //         }

        //         if ($order["kode_layanan"] != NULL) {
        //             foreach ($layanan->select("harga_layanan")->where("kode_layanan", $order["kode_layanan"])->first() as $harga_layanan) {
        //                 $total += $harga_layanan;
        //             }
        //         }
        //     }
        //     // echo $total;
        //     $customers->update(["id_pelanggan" => $customer["id_pelanggan"]], ["total" => $total]);
        // }
        $transaksi->join("data_pelanggan", "data_pelanggan.id_pelanggan = data_transaksi.id_pelanggan", "inner");

        $data = [
            "transaksi" => $transaksi->findAll(),
            "total" => $total
        ];
        return view('header', ["title" => "Transaksi"]) . view('menu') . view('admin/transaksi', $data);
    }
}
