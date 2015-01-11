<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLocationColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('accounts', function(Blueprint $table)
		{
			$table->dropColumn('location');
		});
		Schema::table('accounts', function(Blueprint $table)
		{
			$table->text('location')->default('')->after('password');
		});
		Schema::table('things', function(Blueprint $table)
		{
			$table->dropColumn('location');
		});
		Schema::table('things', function(Blueprint $table)
		{
			$table->text('location')->default('')->after('possessor');
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
			$table->dropColumn('location');
		});
		Schema::table('accounts', function(Blueprint $table)
		{
			$table->string('location')->default('')->after('password');
		});
		Schema::table('things', function(Blueprint $table)
		{
			$table->dropColumn('location');
		});
		Schema::table('things', function(Blueprint $table)
		{
			$table->string('location')->default('')->after('possessor');
		});
	}
}
