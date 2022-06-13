<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDataLayanan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kode_layanan' => [
                'type'           => 'CHAR',
                'constraint' => '4',
            ],
            'nama_layanan' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
            ],
            'harga_layanan' => [
                'type'       => 'INT',
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('kode_layanan', true);
        $this->forge->createTable('data_layanan');
    }

    public function down()
    {
        $this->forge->dropTable('kode_layanan');
    }
}
