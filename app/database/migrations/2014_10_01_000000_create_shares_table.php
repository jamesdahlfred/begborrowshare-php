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
        Schema::create('shares', function($table)
        {
            $table->increments('id');
            $table->integer('sharer')->unsigned();
            $table->integer('receiver')->unsigned();
            $table->boolean('private');
            $table->string('title');
            $table->text('description');
            $table->dateTime('claimed_at');
            $table->dateTime('expires_at');
            // $table->dateTime('created_at');
            // $table->dateTime('updated_at');
            $table->timestamps();
            // $table->dateTime('deleted_at');
            $table->softDeletes();
        });

        Schema::table('shares', function($table) {
            $table->foreign('sharer')->references('id')->on('accounts');
            $table->foreign('receiver')->references('id')->on('accounts');
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
