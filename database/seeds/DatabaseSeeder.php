<?php

use App\User;
use App\cabang;
use App\jabatan;
use App\pegawai;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('UserTableSeeder');
		$this->command->info('User table seeded!');

	}

}

class UserTableSeeder extends Seeder {

	/**
	 * Run the UserTableSeeder.
	 *
	 * @return void
	 */
	public function run()
	{
		//User::truncate();
		User::create([
			'first_name'=>'yosef brahmantyo',
			'last_name'=>'adi k',
			'name'=>'bram',
			'email'=>'brahmantyo.adi@gmail.com',
			'level'=>'SUPER',
			'password'=>Hash::make('123456'),
			'photo'=>'dist/img/bram.jpg'
		]);
		User::create([
			'first_name'=>'nico',
			'last_name'=>'sitepu',
			'name'=>'nico',
			'email'=>'niclogic@gmail.com',
			'level'=>'SUPER',
			'password'=>Hash::make('123456'),
			'photo'=>'dist/img/nico.jpg'
		]);
		User::create([
			'first_name'=>'Mr',
			'last_name'=>'Owner',
			'name'=>'owner',
			'email'=>'owner@lanogansumatraexpress.com',
			'level'=>'MANAGER',
			'password'=>Hash::make('123456'),
			'photo'=>'dist/img/avatar5.png'			
		]);
		User::create([
			'first_name'=>'staf',
			'last_name'=>'1',
			'name'=>'staf1',
			'email'=>'staf1@gmail.com',
			'level'=>'STAFF',
			'password'=>Hash::make('123456'),
			'photo'=>'dist/img/avatar04.png'
		]);
	}
}