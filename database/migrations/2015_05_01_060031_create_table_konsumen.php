<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKonsumen extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('konsumen', function(Blueprint $table)
		{
			$table->smallInteger('idkonsumen')->unique()->autoIncrement()->unsigned();
			$table->char('nama',30);
			$table->text('alamat');
			$table->char('notelp',16);
			$table->char('email',25)->default('@');
			$table->char('contactperson',30);
			$table->date('tgldaftar')->default(date('Y-m-d'));
			// $table->double('totalpiutang',16,2)->default(0);
			// $table->double('totaldeposit',16,2)->default(0);
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
		//
		Schema::drop('konsumen');
	}

}
