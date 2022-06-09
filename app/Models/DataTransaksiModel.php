<?php

namespace App\Models;

use CodeIgniter\Model;

class DataTransaksiModel extends Model
{
    protected $table = 'data_transaksi';
    protected $primaryKey = 'id_transaksi';

    protected $returnType = 'array';
}
