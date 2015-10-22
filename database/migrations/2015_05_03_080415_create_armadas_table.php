<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArmadasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('armada', function(Blueprint $table)
		{
			$table->char('nopolisi',15)->unique();
			$table->char('jeniskendaraan',30);
			$table->char('tahun',4);
			$table->char('syn',1)->default('0');

			$table->primary('nopolisi');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('armada');
	}

}
