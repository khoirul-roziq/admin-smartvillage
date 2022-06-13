<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDataBarang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kode_barang' => [
                'type'           => 'CHAR',
                'constraint' => '4',
            ],
            'nama_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
            ],
            'harga_barang' => [
                'type'       => 'INT',
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('kode_barang', true);
        $this->forge->createTable('data_barang');
    }

    public function down()
    {
        $this->forge->dropTable('kode_barang');
    }
}
