<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists('transactions');
		Schema::create('transactions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('account')->unsigned();
			$table->string('action');
			$table->decimal('amount', 11, 2);
			$table->integer('cancelled_by')->unsigned();
			$table->dateTime('cancelled_at');
			$table->integer('reversed_by')->unsigned();
			$table->dateTime('reversed_at')->nullable();
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
		Schema::drop('transactions');
	}

}
