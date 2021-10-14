<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'      => [
				'type'           => 'INT',
				'constraint'     => 11,
				'auto_increment' => true,
			],
			'username'=> [
				'type'           => 'VARCHAR',
				'constraint'     => 128,
			],
			'email'   => [
				'type'           => 'VARCHAR',
				'constraint'     => 128,
			],
			'password' => [
				'type'           => 'VARCHAR',
				'constraint'     => 128,
			],
			'level' => [
				'type'           => 'INT',
				'constraint'     => 1,
			],
			'statuspegawai'=> [
				'type'           => 'VARCHAR',
				'constraint'     => 128,
			],
			'nip'   => [
				'type'           => 'VARCHAR',
				'constraint'     => 128,
			],
			'nohp'=> [
				'type'           => 'VARCHAR',
				'constraint'     => 128,
				'null'           => true,
			],
			'photo'=> [
				'type'           => 'VARCHAR',
				'constraint'     => 225,
				'null'           => true,
			],
			'statusAktif'=> [
				'type'           => 'VARCHAR',
				'constraint'     => 128,
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
		$this->forge->createTable('user');
	}

	public function down()
	{
		$this->forge->dropTable('user');
	}
}
