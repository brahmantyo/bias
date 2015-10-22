<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKlaimkonsumensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pembayaranklaimkonsumen', function(Blueprint $table)
		{
			$table->char('nokwitansi',15)->unique();
			$table->date('tglklaim');
			$table->char('noresi',20);
			$table->text('keterangan');
			$table->double('nilaiklaim',16,2)->default(0);
			$table->char('status',10)->default('-');
		});

		Schema::table('pembayaranklaimkonsumen', function(Blueprint $table)
		{
			$table->foreign('noresi')->references('noresi')->on('daftarresi');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pembayaranklaimkonsumen', function(Blueprint $table)
		{
			$table->dropForeign('pembayaranklaimkonsumen_noresi_foreign');
		});
		Schema::drop('pembayaranklaimkonsumen');
	}

}
