<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Petugas extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
					'type'           => 'INT',
					'constraint'     => 11,
					'auto_increment' => true,
			],
			'id_user'       => [
					'type'           => 'INT',
					'constraint'     => 11,
					'null'           => true,
			],
			'id_sk'       => [
					'type'           => 'INT',
					'constraint'     => 11,
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
		$this->forge->createTable('petugas');
	}

	

	public function down()
	{
		$this->forge->dropTable('petugas');
	}
}
