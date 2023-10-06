<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Report extends Migration
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
			'uid'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
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
            'tanggalPengajuan'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
            'tanggalPengembalian'       => [
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
            'BBM'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at' => [
				'type'           => 'DATETIME',
				'null'           => true,
			]
		]);
		$this->forge->addPrimaryKey('id', true);
		$this->forge->createTable('Report');
    }

    public function down()
    {
        $this->forge->dropTable('Report');
    }
}
