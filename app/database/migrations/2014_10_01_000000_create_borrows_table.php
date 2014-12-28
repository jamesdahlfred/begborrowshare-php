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
        Schema::create('borrows', function($table)
        {
            $table->increments('id');
            $table->integer('thing')->unsigned();
            $table->integer('lender')->unsigned();
            $table->integer('borrower')->unsigned();
            $table->boolean('private');
            $table->text('circumstances'); // (of thing)
            $table->text('conditions'); // (for use and return)
            $table->text('consequences'); // (for non-return)
            $table->dateTime('lent_at');
            $table->dateTime('expires_at');
            // $table->dateTime('created_at');
            // $table->dateTime('updated_at');
            $table->timestamps();
            // $table->dateTime('deleted_at');
            $table->softDeletes();
        });		

        Schema::table('borrows', function($table) {
            $table->foreign('thing')->references('id')->on('things');
            $table->foreign('lender')->references('id')->on('accounts');
            $table->foreign('borrower')->references('id')->on('accounts');
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
