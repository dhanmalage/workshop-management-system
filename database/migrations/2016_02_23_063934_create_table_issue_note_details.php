<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableIssueNoteDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_note_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('issue_note_id')->unsigned();
            $table->integer('job_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->string('item_description');
            $table->integer('quantity_requested');
            $table->integer('quantity_issued');
            $table->timestamps();

            $table->foreign('issue_note_id')->references('id')->on('issue_notes');
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->foreign('item_id')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('issue_note_details');
    }
}
