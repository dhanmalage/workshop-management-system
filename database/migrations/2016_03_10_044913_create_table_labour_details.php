<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLabourDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labour_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('labour_id')->unsigned();
            $table->integer('job_id')->unsigned();
            $table->integer('employee_id')->unsigned();
            $table->integer('normal_hrs')->nullable();
            $table->integer('normal_min')->nullable();
            $table->integer('ot_hrs')->nullable();
            $table->integer('ot_min')->nullable();
            $table->integer('dot_hrs')->nullable();
            $table->integer('dot_min')->nullable();
            $table->integer('other_hrs')->nullable();
            $table->integer('other_min')->nullable();
            $table->timestamps();

            $table->foreign('labour_id')->references('id')->on('labours');
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->foreign('employee_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('labour_details');
    }
}
