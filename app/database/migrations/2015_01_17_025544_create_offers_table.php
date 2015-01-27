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
        Schema::create('offers', function($table)
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

        Schema::table('offers', function($table) {
            $table->foreign('giver')->references('id')->on('accounts');
            $table->foreign('receiver')->references('id')->on('accounts');
            $table->foreign('thing')->references('id')->on('things');
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
