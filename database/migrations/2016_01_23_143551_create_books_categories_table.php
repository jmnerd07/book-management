<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('book_id')->unsigned()->nullable();
            $table->bigInteger('genre_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('genre_id')->references('id')->on('categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('books_categories');
    }
}
