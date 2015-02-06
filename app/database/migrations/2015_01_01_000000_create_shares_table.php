<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSharesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists('shares');
		Schema::create('shares', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sharer')->unsigned();
			$table->integer('receiver')->unsigned();
			$table->boolean('private')->default(false);
			$table->string('title')->default('');
			$table->text('description')->default('');
			$table->string('categories')->nullable();
			$table->dateTime('claimed_at')->nullable();
			$table->dateTime('expires_at')->nullable();
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
		Schema::drop('shares');
	}

}
