<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnParentGenreId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('genres', function (Blueprint $table) {
            $table->bigInteger('parent_genre_id')->unsigned()->nullable();
            $table->foreign('parent_genre_id')->references('id')->on('genres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('genres', function (Blueprint $table) {
            $table->dropForeign('genres_parent_genre_id_foreign');
            $table->dropColumn('parent_genre_id');
        });
    }
}
