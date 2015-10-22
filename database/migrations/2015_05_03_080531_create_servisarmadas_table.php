<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServisarmadasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('servisarmada', function(Blueprint $table)
		{
			$table->smallInteger('id')->unique()->autoIncrement()->unsigned();
			$table->char('nopolisi',10);
			$table->date('tglservis');
			$table->double('totalpengeluaran')->default(0);
			$table->char('diketahui',30)->default('-');
			
		});
		Schema::table('servisarmada', function(Blueprint $table)
		{
			$table->foreign('nopolisi')->references('nopolisi')->on('armada');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('servisarmada', function(Blueprint $table)
		{
			$table->dropForeign('servisarmada_nopolisi_foreign');
		});
		Schema::drop('servisarmada');
	}

}
