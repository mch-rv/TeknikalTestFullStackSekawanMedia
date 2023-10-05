<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cars extends Migration
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
			'jenisMobil'          => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'noPolisi'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'Driver'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
            'BBM'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
            'jadwalService'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
            'riwayatPemakaian'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
            'headDivApprov'       => [
				'type'           => 'BOOLEAN',
				'null'       	 => true,
			],
            'managerApprov'       => [
				'type'           => 'BOOLEAN',
				'null'       	 => true,
			],
			'created_at' => [
				'type'           => 'DATETIME',
				'null'       	 => true,
			],
		]);
		$this->forge->addPrimaryKey('id', true);
		$this->forge->createTable('Cars');
    }

    public function down()
    {
        $this->forge->dropTable('Cars');
    }
}
