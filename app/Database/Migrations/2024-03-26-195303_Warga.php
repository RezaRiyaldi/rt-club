<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Warga extends Migration
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
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'fullname' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'no_kk' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
            ],
            'no_ktp' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
                'null'       => true,
            ],
            'place_of_birth' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'birth_of_day' => [
                'type'       => 'DATETIME',
            ],
            'work' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'      => true
            ],
            'blood_group' => [
                'type'       => 'VARCHAR',
                'constraint' => '2',
                'default'   => '-'
            ],
            'address' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'religion' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'default'   => 'Islam'
            ],
            'marital_status' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_by' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_by' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_by' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('wargas');
    }

    public function down()
    {
        $this->forge->dropTable('wargas');
    }
}
