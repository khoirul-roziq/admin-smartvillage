<?php

namespace App\Models;

use CodeIgniter\Model;

class DataBarangModel extends Model
{
    protected $table = 'data_barang';
    protected $primaryKey = 'kode_barang';
    protected $allowedFields = ["kode_barang", "nama_barang", "harga_barang"];
}
