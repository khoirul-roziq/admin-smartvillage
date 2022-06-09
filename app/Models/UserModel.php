<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $returnType = 'array';
    protected $allowedFields = ['username', 'password', 'nama_lengkap', 'email', 'no_telp', 'alamat'];
}
