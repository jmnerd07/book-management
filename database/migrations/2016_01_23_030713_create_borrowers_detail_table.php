<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowersDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrower_details', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('borrower_id')->unsigned();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('complete_address')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('civil_status')->nullable();
            $table->integer('record_id')->unsigned()->nullable();
            $table->bigInteger('user_id_modifier')->unsigned()->nullable();
            $table->bigInteger('user_id_creator')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('borrower_id')->references('id')->on('borrower_accounts')->onDelete('cascade');
            $table->foreign('record_id')->references('id')->on('borrower_details')->onDelete('cascade');
            $table->foreign('user_id_creator')->references('id')->on('users')->onDelete('set null');
            $table->foreign('user_id_modifier')->references('id')->on('users')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('borrower_details');
    }
}
