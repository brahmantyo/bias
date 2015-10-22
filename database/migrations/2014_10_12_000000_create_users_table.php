<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->smallInteger('id')->unique()->autoIncrement()->unsigned();
		    $table->char('first_name',25);
		    $table->char('last_name',25);
			$table->char('name',25)->unique();
			$table->char('email',50)->unique();
			$table->char('password', 60);
			$table->enum('level',['SUPER','MANAGER','STAFF']);
			$table->string('photo');
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
