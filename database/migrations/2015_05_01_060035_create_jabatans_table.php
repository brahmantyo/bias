<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJabatansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jabatan', function(Blueprint $table)
		{
			$table->smallInteger('idjabatan')->unique()->autoIncrement()->unsigned();
			$table->char('nmjabatan',15);
			$table->char('syn',1)->default('0');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('jabatan');
	}

}
