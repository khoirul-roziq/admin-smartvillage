<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_pks' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'id_pelanggan' => [
                'type'       => 'INT',
                'unsigned' => true,
            ],
            'kode_barang' => [
                'type' => 'CHAR',
                'constraint' => '4',
            ],
            'kode_layanan' => [
                'type' => 'CHAR',
                'constraint' => '4',
            ],
            'nama_pj' => [
                'type' => 'VARCHAR',
                'constraint' => '128'
            ]
        ]);
        $this->forge->addKey('id_transaksi', true);
        $this->forge->createTable('transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('id_transaksi');
    }
}
