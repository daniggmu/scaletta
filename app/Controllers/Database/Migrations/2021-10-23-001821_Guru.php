<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Guru extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                  => [
                'type'           => 'INT',
                'constraint'     => '11',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'nip'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'nama'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => TRUE,

            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('guru');
    }

    public function down()
    {
        $this->forge->dropTable('guru');
    }
}
