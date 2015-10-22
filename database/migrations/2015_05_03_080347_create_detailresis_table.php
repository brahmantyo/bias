<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailresisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detailresi', function(Blueprint $table)
		{
			$table->smallInteger('id')->unique()->autoIncrement()->unsigned();
			$table->char('idresi',20);
			$table->char('barang',25)->default('-');
			$table->smallInteger('qty')->default(0);
			$table->enum('satuan',['Kg','Ton','Koli'])->default('Kg');
			$table->double('hrgsatuan',16,2)->default(0);
			$table->double('subtotal',16,2)->default(0);

		});

		Schema::table('detailresi', function(Blueprint $table)
		{
			$table->foreign('idresi')->references('noresi')->on('daftarresi');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('detailresi', function(Blueprint $table)
		{
			$table->dropForeign('detailresi_idresi_foreign');
		});

		Schema::drop('detailresi');
	}

}
