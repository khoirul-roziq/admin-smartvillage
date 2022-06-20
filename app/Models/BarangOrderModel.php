<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangOrderModel extends Model
{
    protected $table = 'barang_order';
    protected $primaryKey = 'id_barang';
    protected $allowedFields = ["id_barang", "kode_barang", "nama_barang", "qty", "harga_barang", "id_transaksi"];
}
