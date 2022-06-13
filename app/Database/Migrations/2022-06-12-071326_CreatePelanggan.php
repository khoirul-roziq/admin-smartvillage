<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePelanggan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pelanggan' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_pelanggan' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
            ],
            'nama_desa' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
                'null' => true,
            ],
            'no_telp' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
                'null' => true,
            ],
            'alamat' => [
                'type'       => 'TEXT',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_pelanggan', true);
        $this->forge->createTable('data_pelanggan');
    }

    public function down()
    {
        $this->forge->dropTable('id_pelanggan');
    }
}
