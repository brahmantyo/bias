<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCabangsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cabang', function(Blueprint $table)
		{
			$table->smallInteger('idcabang')->unique()->autoIncrement()->unsigned();
			$table->char('nama',30);
			$table->text('alamat')->nullable();
			$table->char('telp',15)->nullable();
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
		Schema::drop('cabang');
	}

}
