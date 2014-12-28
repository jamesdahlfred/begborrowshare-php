<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBegsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('begs', function($table)
		{
			$table->increments('id');
			$table->integer('beggar')->unsigned();
			$table->integer('benefactor')->unsigned();
			$table->boolean('private');
			$table->string('title');
			$table->text('description');
			$table->string('location');
			$table->dateTime('fulfilled_at');
			$table->dateTime('expires_at');
			// $table->dateTime('created_at');
			// $table->dateTime('updated_at');
			$table->timestamps();
			// $table->dateTime('deleted_at');
			$table->softDeletes();
		});

		Schema::table('begs', function($table) {
			$table->foreign('beggar')->references('id')->on('accounts');
			$table->foreign('benefactor')->references('id')->on('accounts');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('begs');
	}

}
