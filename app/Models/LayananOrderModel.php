<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananOrderModel extends Model
{
    protected $table = 'layanan_order';
    protected $primaryKey = 'id_layanan';
    protected $allowedFields = ["id_layanan", "kode_layanan", "nama_layanan", "harga_layanan", "id_transaksi"];
}
