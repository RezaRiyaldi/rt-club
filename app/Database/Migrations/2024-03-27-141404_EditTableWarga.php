<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditTableWarga extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('wargas', [
            'birth_of_day' => [
                'type' => 'DATE',
            ]
        ]);

        $db = \Config\Database::connect();

        if (!$db->fieldExists('religion', 'wargas')) {
            $this->forge->addColumn('wargas', [
                'religion' => [
                    'type' => 'VARCHAR',
                    'contraint' => 20,
                    'default' => 'Islam'
                ]
            ]);
        }

        if (!$db->fieldExists('gender', 'wargas')) {
            $this->forge->addColumn('wargas', [
                'gender' => [
                    'type' => 'VARCHAR',
                    'contraint' => 20,
                    'null' => true
                ]
            ]);
        }

        if (!$db->fieldExists('picture', 'wargas')) {
            // $this->forge->addColumn('wargas', [
            //     'picture' => [
            //         'type' => 'text',
            //         'null' => true
            //     ]
            // ]);

            $query = "ALTER TABLE wargas ADD COLUMN picture TEXT BEFORE created_at";
            $db->query($query);
        }
    }



    public function down()
    {
        //
    }
}
