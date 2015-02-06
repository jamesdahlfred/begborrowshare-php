<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists('borrows');
		Schema::create('borrows', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('thing')->unsigned();
			$table->integer('lender')->unsigned();
			$table->integer('borrower')->unsigned();
			$table->boolean('private')->default(false);
			$table->text('circumstances')->default(''); // (of thing)
			$table->text('conditions')->default(''); // (for use and return)
			$table->text('consequences')->default(''); // (for non-return)
			$table->dateTime('lent_at')->nullable();
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
		Schema::drop('borrows');
	}

}
