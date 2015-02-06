<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists('reviews');
		Schema::create('reviews', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('reviewer')->unsigned();
			$table->integer('review_of')->unsigned();
			$table->boolean('flagged')->default(false);
			$table->string('comment')->default('');
			$table->tinyInteger('rating')->default(0); // 1 to 5
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
		Schema::drop('reviews');
	}

}
