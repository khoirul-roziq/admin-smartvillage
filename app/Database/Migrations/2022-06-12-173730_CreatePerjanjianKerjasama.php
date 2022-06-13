<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePerjanjianKerjasama extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pks' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_desa' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
            ],
            'nama_kades' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
            ],
            'tanggal_pks' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
            ],
        ]);
        $this->forge->addKey('id_pks', true);
        $this->forge->createTable('perjanjian_kerjasama');
    }

    public function down()
    {
        $this->forge->dropTable('id_pks');
    }
}
