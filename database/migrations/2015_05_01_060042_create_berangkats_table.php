<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBerangkatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('berangkat', function(Blueprint $table)
		{
			$table->char('idberangkat',20)->unique();
			$table->char('nopolisi',10);
			$table->smallInteger('idsopir')->unsigned();
			$table->smallInteger('idkenek')->unsigned();
			$table->smallInteger('idasal')->unsigned();
			$table->smallInteger('idtujuan')->unsigned();
			$table->date('tglberangkat');
			$table->time('jamberangkat');
			$table->date('tgltiba')->nullable();
			$table->time('jamtiba')->nullable();
			$table->smallInteger('user')->unsigned();
			$table->char('syn',1)->default('0');

			$table->primary('idberangkat');

		});

		Schema::table('berangkat', function(Blueprint $table)
		{
			$table->foreign('idsopir')->references('idpegawai')->on('pegawai');
			$table->foreign('idkenek')->references('idpegawai')->on('pegawai');
			$table->foreign('user')->references('id')->on('users');
			//$table->foreign('idasal')->references('idcabang')->on('cabang');
			//$table->foreign('idtujuan')->references('idcabang')->on('cabang');	
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('berangkat', function(Blueprint $table)
		{
			$table->dropForeign('berangkat_idsopir_foreign');
			$table->dropForeign('berangkat_idkenek_foreign');
			//$table->dropForeign('berangkat_idasal_foreign');
			//$table->dropForeign('berangkat_idtujuan_foreign');
		});
		Schema::drop('berangkat');
	}

}
