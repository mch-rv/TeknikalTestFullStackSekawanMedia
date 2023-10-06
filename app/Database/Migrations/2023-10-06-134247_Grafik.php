<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Grafik extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'year'          => [
				'type'           => 'VARCHAR',
				'constraint'     => '4',
			],
			'jumlah'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
            'updated_at' => [
				'type'           => 'DATETIME',
				'null'           => true,
			]
		]);
		$this->forge->addPrimaryKey('id', true);
		$this->forge->createTable('grafik');
    }

    public function down()
    {
        $this->forge->dropTable('grafik');
    }
}
