<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->longText('description')->nullable();
			$table->bigInteger('user_id')->unsigned()->nullable();
			$table->bigInteger('record_id')->unsigned()->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
			$table->foreign('record_id')->references('id')->on('categories')->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories');
	}
}
