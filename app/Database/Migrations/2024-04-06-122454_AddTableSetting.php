<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTableSettings extends Migration
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
            'keyword' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
            ],
            'value' => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('settings');
    }

    public function down()
    {
        //
    }
}
