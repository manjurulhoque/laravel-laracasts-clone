<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
			'name' => 'admin',
	        'password' => bcrypt('123456'),
	        'email' => 'admin@gmail.com',
	        'admin' => 1,
	        'provider' => '0',
	        'provider_id' => '0'
        ]);
    }
}
