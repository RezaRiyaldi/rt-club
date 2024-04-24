<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTableIuran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'type' => [
                'type'           => 'VARCHAR',
                'constraint'     => 20,
            ],
            'description' => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('iuran_type');

        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'type_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'warga_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'nominal' => [
                'type'          => 'DECIMAL',
                'constraint'    => '10,2',
            ],            
            'payment_method' => [
                'type'          => 'VARCHAR',
                'constraint'    => '20',
            ],            
            'bukti_bayar' => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'description' => [
                'type'           => 'TEXT',
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
        $this->forge->addForeignKey('warga_id', 'wargas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('type_id', 'iuran_type', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('iurans');
    }

    public function down()
    {
        //
    }
}
