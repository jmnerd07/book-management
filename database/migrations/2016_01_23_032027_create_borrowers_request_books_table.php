<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowersRequestBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowers_request_books', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('book_id')->unsigned();
            $table->bigInteger('request_id')->unsigned()->nullable();
            $table->integer('count')->default(0);
            $table->dateTime('return_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('request_id')->references('id')->on('borrowers_requests')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('borrowers_request_books');
    }
}
