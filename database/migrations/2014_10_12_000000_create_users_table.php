<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->boolean('active')->default(TRUE);
            $table->string('salt');
            $table->integer('access_id')->unsigned()->nullable();
            $table->bigInteger('record_id')->unsigned()->nullable();
            $table->bigInteger('created_by_id')->unsigned()->nullable();
            $table->bigInteger('modified_by_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('record_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('modified_by_id')->references('id')->on('users')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
