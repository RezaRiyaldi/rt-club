<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTablePengeluaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'pengeluaran' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
            ],
            'description' => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'nominal' => [
                'type'          => 'DECIMAL',
                'constraint'    => '10,2',
            ], 
            'periode' => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'created_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'created_by' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'updated_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_by' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('pengeluarans');
    }

    public function down()
    {
        //
    }
}
