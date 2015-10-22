<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RubahTableKlaimkonsumenToPembayaranklaimkonsumen extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Schema::rename('klaimkonsumen','pembayaranklaimkonsumen');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Schema::rename('pembayaranklaimkonsumen','klaimkonsumen');
	}

}
