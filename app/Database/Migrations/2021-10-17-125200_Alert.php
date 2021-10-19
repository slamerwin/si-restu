<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Alert extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
					'type'           => 'INT',
					'constraint'     => 11,
					'auto_increment' => true,
			],
			'status'       => [
					'type'           => 'VARCHAR',
					'constraint'     => 250,
					'null'           => true,
			],
			'id_sk'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'           => true,
			],
			'ketua'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'           => true,
			],
			'admin'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'           => true,
			],
			'superAdmin'       => [
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
		$this->forge->createTable('notif');
	}

	public function down()
	{
		$this->forge->dropTable('notif');
	}
}
