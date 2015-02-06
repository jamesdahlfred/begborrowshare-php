<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists('things');
		Schema::create('things', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('owner')->unsigned();
			$table->integer('possessor')->unsigned();
			$table->text('location')->default('');
			$table->string('title')->default('');
			$table->text('description')->default('');
			$table->string('tags')->nullable();
			$table->text('specs')->default('');
			$table->string('images')->default('');
			// $table->dateTime('created_at');
			// $table->dateTime('updated_at');
			$table->timestamps();
			// $table->dateTime('deleted_at');
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('things');
	}

}
