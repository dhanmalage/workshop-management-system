<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('estimate_id')->unsigned();
            $table->date('promised_date');
            $table->integer('s_adviser')->unsigned();
            $table->string('status')->nullable();
            $table->decimal('grand_total', 10, 2);
            $table->text('remarks')->nullable();
            $table->integer('tested_by')->unsigned()->nullable();
            $table->integer('section_incharge')->unsigned();
            $table->string('labour_status')->nullable();
            $table->string('consumptions_status')->nullable();
            $table->integer('created_by')->unsigned();
            $table->timestamps();

            $table->foreign('estimate_id')->references('id')->on('estimates');
            $table->foreign('s_adviser')->references('id')->on('employees');
            $table->foreign('tested_by')->references('id')->on('employees');
            $table->foreign('section_incharge')->references('id')->on('employees');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jobs');
    }
}
