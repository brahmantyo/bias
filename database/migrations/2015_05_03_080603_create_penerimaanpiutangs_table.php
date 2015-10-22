<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenerimaanpiutangsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Schema::create('penerimaanpiutang', function(Blueprint $table)
		// {
		// 	$table->smallInteger('idkonsumen')->unsigned();
		// 	$table->double('nilaiterima',16,2)->default(0);
		// 	$table->date('tglterima');
		// 	$table->char('nokwitansi',15)->default('-');
		// 	$table->double('ambildeposit',16,2)->default(0);
		// 	$table->double('nilaiagihan',16,2)->default(0);
		// });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Schema::drop('penerimaanpiutang');
	}

}
