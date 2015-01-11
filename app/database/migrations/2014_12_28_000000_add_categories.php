<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('begs', function(Blueprint $table)
		{
			$table->string('categories')->after('description')->nullable();
		});
		Schema::table('shares', function(Blueprint $table)
		{
			$table->string('categories')->after('description')->nullable();
		});		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('begs', function(Blueprint $table)
		{
			$table->dropColumn('categories');
		});
		Schema::table('shares', function(Blueprint $table)
		{
			$table->dropColumn('categories');
		});
	}
}
