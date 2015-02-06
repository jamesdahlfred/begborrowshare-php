<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists('offers');
		Schema::create('offers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('kind'); // borrow, share
			$table->string('status');
			$table->integer('giver')->unsigned();
			$table->integer('receiver')->unsigned();
			$table->integer('thing')->unsigned();
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
		Schema::drop('offers');
	}

}
