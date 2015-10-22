<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetdepositsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Schema::create('setdeposit', function(Blueprint $table)
		// {
		// 	$table->smallInteger('idkonsumen')->unsigned();
		// 	$table->double('nilai',16,2);
		// 	$table->date('tglsetoran');
		// });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Schema::drop('setdeposit');
	}

}
