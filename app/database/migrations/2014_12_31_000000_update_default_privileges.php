<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDefaultPrivileges extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('accounts', function(Blueprint $table)
		{
			$table->dropColumn('privileges');
		});
		Schema::table('accounts', function(Blueprint $table)
		{
			$table->string('privileges')->default('');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('accounts', function(Blueprint $table)
		{
			$table->dropColumn('privileges');
		});
		Schema::table('accounts', function(Blueprint $table)
		{
			$table->string('privileges');
		});
	}
}
