<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists('images');
		Schema::create('images', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('thing')->unsigned();
			$table->string('url');
			$table->text('caption')->default('');
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
		Schema::drop('images');
	}

}
