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
		/////////
		cabang::create([
			'nama'=>'Cabang Bandung Pusat',
			'alamat'=>'Jl.Suka Menak No.147',
			'telp'=>'022-123421'
		]);
/*		///for  demo only
		//cabang
		cabang::create([
			'nama'=>'Cabang Pekan Baru',
			'alamat'=>'Jl.Tetap Jaya No.212',
			'telp'=>''
		]);
		cabang::create([
			'nama'=>'Cabang Medan',
			'alamat'=>'Jl.Ngumban Surbakti',
			'telp'=>'414214'
		]);
		//armada
		armada::create([
			'nopolisi'=>'BK 212007 CD',
			'jeniskendaraan'=>'Mitshubishi Fuso',
			'tahun'=>'2000'
		]);
		//jabatan
		jabatan::create([
			'nmjabatan'=>'Manager'
		]);
		jabatan::create([
			'nmjabatan'=>'Administrasi'
		]);
		jabatan::create([
			'nmjabatan'=>'Driver'
		]);
		jabatan::create([
			'nmjabatan'=>'Kenek'
		]);
		jabatan::create([
			'nmjabatan'=>'Gudang'
		]);
		jabatan::create([
			'nmjabatan'=>'Programmer'
		]);
		jabatan::create([
			'nmjabatan'=>'Teknisi'
		]);
		//konsumen
		konsumen::create([
			'nama'=>'Ari Lasso Sitepu',
			'alamat'=>'dfjsdnfasd',
			'notelp'=>'12346',
			'email'=>'sdfa@sdj',
			'contactperson'=>'asas',
			'tgldaftar'=>'2015-06-18'
			'syn'=>'1'
		]);
		konsumen::create([
			'nama'=>'Nico Stepanus Sitepu',
			'alamat'=>'Jl.Anis No.01',
			'notelp'=>'082115190115',
			'email'=>'nico@niclogic.com',
			'contactperson'=>'Athan Doe',
			'tgldaftar'=>'2015-06-18'
			'syn'=>'1'
		]);
		konsumen::create([
			'nama'=>'Angelus Aron Rallo Sitepu',
			'alamat'=>'Jl.Anis Oge',
			'notelp'=>'081322967684',
			'email'=>'aron@niclogic.com',
			'contactperson'=>'Rallo',
			'tgldaftar'=>'2015-06-18'
			'syn'=>'1'
		]);
		//pegawai
		pegawai::create([
			'nama'=>'Paijo',
			'alamat'=>'Klaten',
			'idjabatan'=>'3',
			'tglrekrut'=>'2015-06-01',
			'gajipokok'=>'300000.00',
		]);
		pegawai::create([
			'nama'=>'Bejo',
			'alamat'=>'Yogyakarta',
			'idjabatan'=>'3',
			'tglrekrut'=>'2015-06-02',
			'gajipokok'=>'100000.00',
		]);
		pegawai::create([
			'nama'=>'Enda',
			'alamat'=>'Bandung

',
			'idjabatan'=>'1',
			'tglrekrut'=>'2015-06-23',
			'gajipokok'=>'150000.00',
		]);
		pegawai::create([
			'nama'=>'Nico Doe',
			'alamat'=>'Sukanalu',
			'idjabatan'=>'6',
			'tglrekrut'=>'2005-01-01',
			'gajipokok'=>'20000000.00',
		]);	
		//	demo only	*/	
	}

}