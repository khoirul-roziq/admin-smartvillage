<?php

namespace App\Models;

use CodeIgniter\Model;

class DataPelangganModel extends Model
{
    protected $table = 'data_pelanggan';
    protected $primaryKey = 'id_pelanggan';

    protected $allowedFields = [
        'id_pelanggan',
        'nama_pelanggan',
        'nama_desa',
        'no_telp',
        'email',
        'alamat',
    ];
}
