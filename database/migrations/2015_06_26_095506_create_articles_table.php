<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('article', function(Blueprint $table)
		{
			$table->increments('id');
			$table->enum('type',['about','news','memo']);
			$table->char('title',100);
			$table->char('author',10)->nullable();
			$table->text('description',255)->nullable();
			$table->char('keywords',30)->nullable();
			$table->char('scontent',255)->nullable;
			$table->text('content',255)->nullable();
			$table->smallInteger('user');
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
		Schema::drop('article');
	}

}
