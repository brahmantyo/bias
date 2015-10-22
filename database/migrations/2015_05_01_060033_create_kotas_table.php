<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKotasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
/*		Schema::create('kota', function(Blueprint $table)
		{
			$table->char('kode',4)->unique();
			$table->char('namakota',15);

			$table->primary('kode');
		});*/
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
/*		Schema::drop('kota');*/
	}

}
