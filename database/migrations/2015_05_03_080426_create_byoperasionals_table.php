<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateByoperasionalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('byoperasional', function(Blueprint $table)
		{
			$table->char('idtransaksi',20)->unique();
			$table->double('nilai',16,2);
			$table->date('tanggal');
			$table->text('keterangan');

			$table->primary('idtransaksi');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('byoperasional');
	}

}
