<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameTableDaftarresiToResi extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
/*		Schema::table('detailresi',function(Blueprint $table){
			$table->dropForeign('detailresi_idresi_foreign');
		});*/
		Schema::rename('daftarresi','resi');
		/*Schema::table('detailresi',function(Blueprint $table){
			$table->foreign('idresi')->references('noresi')->on('resi');
		});*/
		// Schema::table('resi',function(Blueprint $table){
		// 	$table->dropForeign('daftarresi_idberangkat_foreign');
		// 	$table->renameColumn('idberangkat','idsjn')->change();
		// });
		//Schema::rename('berangkat','suratjalan');
		// Schema::table('suratjalan',function(Blueprint $table){
		// 	$table->renameColumn('idberangkat','idsjn')->change();
		// });
		// Schema::table('resi',function(Blueprint $table){
		// 	$table->foreign('idsjn')->references('idberangkat')->on('berangkat');
		// });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Schema::table('resi',function(Blueprint $table){
		// 	$table->dropForeign('resi_idsjn_foreign');
		// });
		// //Schema::rename('suratjalan','berangkat');
		// Schema::table('resi',function(Blueprint $table){
		// 	$table->renameColumn('idsjn','idberangkat')->change();
		// });		
		// Schema::table('berangkat',function(Blueprint $table){
		// 	$table->renameColumn('idsjn','idberangkat')->change();
		// });
		Schema::rename('resi','daftarresi');
		// Schema::table('daftarresi',function(Blueprint $table){
		// 	$table->foreign('idberangkat')->references('idberangkat')->on('berangkat');
		// });
	}
}
