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
        Schema::create('accounts', function($table)
        {
            $table->increments('id');
            $table->string('privileges');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('location');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('social');
            $table->string('last_ip');
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
        Schema::drop('accounts');
    }

}
