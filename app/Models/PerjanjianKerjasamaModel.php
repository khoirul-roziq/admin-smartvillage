<?php

namespace App\Models;

use CodeIgniter\Model;

class PerjanjianKerjasamaModel extends Model
{
    protected $table = 'perjanjian_kerjasama';
    protected $primaryKey = 'id_pks';
    protected $allowedFields    = [
        'id_pks',
        'nama_desa',
        'nama_kades',
        'tanggal',
        'id_transaksi'
    ];
}
