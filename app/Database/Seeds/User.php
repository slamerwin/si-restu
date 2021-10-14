<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use GibberishAES;

class User extends Seeder
{
	public function run()
	{
		$this->cerip = new GibberishAES();
		$data =[
			[
				'username' => 'Joko',
				'email' => 'superadmin@gmail.com',
				'password'    => $this->cerip->encrypt_data('superadmin'),
				'level' => 1,
				'created_at' => Time::now()
			],
			[
				'username' => 'Saipul',
				'email' => 'admin@gmail.com',
				'password'    => $this->cerip->encrypt_data('admin'),
				'level' => 2,
				'created_at' => Time::now()
			],
			[
				'username' => 'Dedi',
				'email' => 'ketua@gmail.com',
				'password'    => $this->cerip->encrypt_data('ketua'),
				'level' => 3,
				'created_at' => Time::now()
			],
			[
				'username' => 'Saipul',
				'email' => 'user@gmail.com',
				'password'    => $this->cerip->encrypt_data('user'),
				'level' => 4,
				'created_at' => Time::now()
			],

		];

		// Using Query Builder
		$this->db->table('user')->insertBatch($data);
	}
}
