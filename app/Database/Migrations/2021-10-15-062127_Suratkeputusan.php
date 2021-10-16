<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Suratkeputusan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
					'type'           => 'INT',
					'constraint'     => 11,
					'auto_increment' => true,
			],
			'no'       => [
					'type'           => 'VARCHAR',
					'constraint'     => 250,
					'null'           => true,
			],
			'tentang'       => [
					'type'           => 'VARCHAR',
					'constraint'     => 250,
					'null'           => true,
			],
			'file'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 250,
				'null'           => true,
			],
			'status'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 250,
				'null'           => true,
			],
		
			'created_at' => [
				'type'           => 'DATETIME',
			],
			'updated_at' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			'deleted_at' => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('suratkeputusan');
	}


	public function down()
	{
		$this->forge->dropTable('suratkeputusan');
	}
}
