<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableReferences extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		//Schema::table('setdeposit', function(Blueprint $table)
		//{
		//	$table->foreign('idkonsumen')->references('idkonsumen')->on('konsumen');
		//});
		//Schema::table('penerimaanpiutang', function(Blueprint $table)
		//{
		//	$table->foreign('idkonsumen')->references('idkonsumen')->on('konsumen');
		//});







	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

		//Schema::table('setdeposit', function(Blueprint $table)
		//{
			//$table->dropForeign('setdeposit_idkonsumen_foreign');
		//	});
		//Schema::table('penerimaanpiutang', function(Blueprint $table)
		//{
			//$table->dropForeign('penerimaanpiutang_idkonsumen_foreign');
		//});







	}
}