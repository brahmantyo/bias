<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGajisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gaji', function(Blueprint $table)
		{
			$table->char('nokwitansi',15)->unique();
			$table->double('nilai',16,2)->default(0);
			$table->date('tanggal');
			$table->smallInteger('idpegawai')->unsigned();
			$table->text('keterangan');
			$table->char('syn',1)->default('0');
		});

		Schema::table('gaji', function(Blueprint $table)
		{
			$table->foreign('idpegawai')->references('idpegawai')->on('pegawai');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('gaji', function(Blueprint $table)
		{
			$table->dropForeign('gaji_idpegawai_foreign');
		});
		Schema::drop('gaji');
	}

}
