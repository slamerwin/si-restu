<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Token extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
					'type'           => 'INT',
					'constraint'     => 11,
					'auto_increment' => true,
			],
			'email'       => [
					'type'           => 'VARCHAR',
					'constraint'     => 250,
			],
			'token'       => [
					'type'           => 'VARCHAR',
					'constraint'     => 250,
			],
			'status'       => [
				'type'           => 'INT',
				'constraint'     => 11,
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
		$this->forge->createTable('token');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_user_token');
	}
}
