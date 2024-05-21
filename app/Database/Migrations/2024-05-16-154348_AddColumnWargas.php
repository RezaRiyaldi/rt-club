<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnWargas extends Migration
{
    public function up()
    {
        $fields = [
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'after' => 'no_ktp'
            ],
            'blok' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'after' => 'blood_group'
            ],
        ];

        $this->forge->addColumn('wargas', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('wargas', 'phone');
        $this->forge->dropColumn('wargas', 'blok');
    }
}
