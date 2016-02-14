<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowersRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowers_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('borrower_id')->unsigned();
            $table->string('status')->default('pending');
            $table->text('notes')->nullable();
            $table->bigInteger('declined_by')->unsigned()->nullable();
            $table->dateTime('date_declined')->nullable();
            $table->bigInteger('approved_by')->unsigned()->nullable();
            $table->dateTime('date_approved')->nullable();
            $table->bigInteger('cancelled_by')->unsigned()->nullable();
            $table->dateTime('date_cancelled')->nullable();
            $table->boolean('cancelled_by_borrower')->nullable();
            $table->bigInteger('record_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('borrower_id')->references('id')->on('borrower_accounts')->onDelete('cascade');
            $table->foreign('record_id')->references('id')->on('borrowers_requests')->onDelete('cascade');
            $table->foreign('declined_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('cancelled_by')->references('id')->on('users')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('borrowers_requests');
    }
}
