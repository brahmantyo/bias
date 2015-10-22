<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pegawai', function(Blueprint $table)
		{
			$table->smallInteger('idpegawai')->unique()->autoIncrement()->unsigned();
			$table->char('nama',30);
			$table->text('alamat');
			$table->smallInteger('idjabatan')->unsigned();
			$table->date('tglrekrut')->default(date('Y-m-d'));
			$table->double('gajipokok',16,2)->default(0);
			$table->char('syn',1)->default('0');

		});

		Schema::table('pegawai', function(Blueprint $table)
		{
			$table->foreign('idjabatan')->references('idjabatan')->on('jabatan');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pegawai', function(Blueprint $table)
		{
			$table->dropForeign('pegawai_idjabatan_foreign');
		});

		Schema::drop('pegawai');
	}

}
