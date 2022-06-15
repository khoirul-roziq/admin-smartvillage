<?php

namespace App\Models;

use CodeIgniter\Model;

class DataLayananModel extends Model
{
    protected $table = 'data_layanan';
    protected $primaryKey = 'kode_layanan';
    protected $allowedFields = ["kode_layanan", "nama_layanan", "harga_layanan"];
}
