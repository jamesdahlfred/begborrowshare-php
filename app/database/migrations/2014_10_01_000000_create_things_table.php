<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThingsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('things', function($table)
        {
            $table->increments('id');
            $table->integer('owner')->unsigned();
            $table->integer('possessor')->unsigned();
            $table->string('location');
            $table->string('title');
            $table->string('description');
            $table->string('specs');
            $table->string('images');
            // $table->dateTime('created_at');
            // $table->dateTime('updated_at');
            $table->timestamps();
            // $table->dateTime('deleted_at');
            $table->softDeletes();
        });

        Schema::table('things', function($table) {
            $table->foreign('owner')->references('id')->on('accounts');
            $table->foreign('possessor')->references('id')->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('things');
    }

}
