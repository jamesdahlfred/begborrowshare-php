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
        Schema::create('reviews', function($table)
        {
            $table->increments('id');
            $table->integer('reviewer')->unsigned();
            $table->integer('review_of')->unsigned();;
            $table->boolean('flagged')->default(false);
            $table->string('comment');
            $table->tinyInteger('rating'); // 1 to 5
            // $table->dateTime('created_at');
            // $table->dateTime('updated_at');
            $table->timestamps();
            // $table->dateTime('deleted_at');
            $table->softDeletes();
        });

        Schema::table('reviews', function($table) {
            $table->foreign('reviewer')->references('id')->on('accounts');
            $table->foreign('review_of')->references('id')->on('accounts');
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
