<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'profil';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nama_instansi', 'alamat', 'email', 'no_hp', 'kode_nota', 'logo'];
}
