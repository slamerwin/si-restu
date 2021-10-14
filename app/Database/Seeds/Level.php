<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class Level extends Seeder
{
	public function run()
	{
		$data =[
			[
				'level' => 1,
				'keterangan' => 'Super Admin',
				'created_at' => Time::now()
			],
			[
				'level' => 2,
				'keterangan' => 'Admin',
				'created_at' => Time::now()
			],
			[
				'level' => 3,
				'keterangan' => 'Ketua',
				'created_at' => Time::now()
			],
			[
				'level' => 4,
				'keterangan' => 'User',
				'created_at' => Time::now()
			],

		];

		// Using Query Builder
		$this->db->table('level')->insertBatch($data);
	}
}
