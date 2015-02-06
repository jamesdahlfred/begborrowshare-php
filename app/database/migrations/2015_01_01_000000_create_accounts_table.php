<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists('accounts');
		Schema::create('accounts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('privileges')->default('');
			$table->string('name');
			$table->string('username')->unique();
			$table->string('password');
			$table->text('location')->default('');
			$table->string('phone')->default('');
			$table->string('email')->unique();
			$table->string('social')->default('');
			$table->string('last_ip');
			// $table->dateTime('created_at');
			// $table->dateTime('updated_at');
			$table->timestamps();
			// $table->dateTime('deleted_at');
			$table->softDeletes();
			$table->rememberToken();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('accounts');
	}

}
