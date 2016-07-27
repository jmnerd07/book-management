<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('isbn',13);
            $table->string('title');
            $table->integer('author_id')->unsigned()->nullable();
            $table->bigInteger('publisher_id')->unsigned()->nullable();
            $table->bigInteger('record_id')->unsigned()->nullable();
            $table->longText('description')->nullable();
            $table->string('img_url')->nullable();
            $table->integer('count')->default(0);
            $table->boolean('available')->default(TRUE);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('set null');
            $table->foreign('publisher_id')->references('id')->on('publishers')->onDelete('set null');
            $table->foreign('record_id')->references('id')->on('books')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('books');
    }
}
