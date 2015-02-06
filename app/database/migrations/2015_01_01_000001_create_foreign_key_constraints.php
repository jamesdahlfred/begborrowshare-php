<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeyConstraints extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('begs', function($table) {
			$table->foreign('beggar')->references('id')->on('accounts');
			$table->foreign('benefactor')->references('id')->on('accounts');
		});

		Schema::table('borrows', function($table) {
			$table->foreign('thing')->references('id')->on('things');
			$table->foreign('lender')->references('id')->on('accounts');
			$table->foreign('borrower')->references('id')->on('accounts');
		});

		Schema::table('images', function($table) {
			$table->foreign('thing')->references('id')->on('things');
		});

		Schema::table('offers', function($table) {
			$table->foreign('giver')->references('id')->on('accounts');
			$table->foreign('receiver')->references('id')->on('accounts');
			$table->foreign('thing')->references('id')->on('things');
		});

		Schema::table('reviews', function($table) {
			$table->foreign('reviewer')->references('id')->on('accounts');
			$table->foreign('review_of')->references('id')->on('accounts');
		});

		Schema::table('shares', function($table) {
			$table->foreign('sharer')->references('id')->on('accounts');
			$table->foreign('receiver')->references('id')->on('accounts');
		});

		Schema::table('things', function($table) {
			$table->foreign('owner')->references('id')->on('accounts');
			$table->foreign('possessor')->references('id')->on('accounts');
		});

		Schema::table('transactions', function($table) {
			$table->foreign('account')->references('id')->on('accounts');
			$table->foreign('cancelled_by')->references('id')->on('accounts');
			$table->foreign('reversed_by')->references('id')->on('accounts');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('begs', function($table) {
			$table->dropForeign('begs_beggar_foreign');
			$table->dropForeign('begs_benefactor_foreign');
		});

		Schema::table('borrows', function($table) {
			$table->dropForeign('borrows_thing_foreign');
			$table->dropForeign('borrows_lender_foreign');
			$table->dropForeign('borrows_borrower_foreign');
		});

		Schema::table('images', function($table) {
			$table->dropForeign('images_thing_foreign');
		});

		Schema::table('offers', function($table) {
			$table->dropForeign('offers_giver_foreign');
			$table->dropForeign('offers_receiver_foreign');
			$table->dropForeign('offers_thing_foreign');
		});

		Schema::table('reviews', function($table) {
			$table->dropForeign('reviews_reviewer_foreign');
			$table->dropForeign('reviews_review_of_foreign');
		});

		Schema::table('shares', function($table) {
			$table->dropForeign('shares_sharer_foreign');
			$table->dropForeign('shares_receiver_foreign');
		});

		Schema::table('things', function($table) {
			$table->dropForeign('things_owner_foreign');
			$table->dropForeign('things_possessor_foreign');
		});

		Schema::table('transactions', function($table) {
			$table->dropForeign('transactions_account_foreign');
			$table->dropForeign('transactions_cancelled_by_foreign');
			$table->dropForeign('transactions_reversed_by_foreign');
		});
	}

}
