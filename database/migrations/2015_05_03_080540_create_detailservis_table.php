<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailservisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detailservis', function(Blueprint $table)
		{
			$table->smallInteger('idservis')->unsigned();
			$table->char('sparepart')->default('-');
			$table->double('biaya',16,2)->default(0);
			$table->char('bengkel',30)->default('-');
			$table->text('keterangan');
		});

		Schema::table('detailservis', function(Blueprint $table)
		{
			$table->foreign('idservis')->references('id')->on('servisarmada');
		});		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('detailservis', function(Blueprint $table)
		{
			$table->dropForeign('detailservis_idservis_foreign');
		});
		Schema::drop('detailservis');
	}

}
