<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_access', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('record_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('record_id')->references('id')->on('user_access')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_access');
    }
}
