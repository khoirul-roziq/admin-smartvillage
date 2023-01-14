<?php

namespace App\Models;

use CodeIgniter\Model;

class TrashModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'nota_trash';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['kode_nota', 'nomor_nota'];
}
