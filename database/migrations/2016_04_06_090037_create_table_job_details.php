<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableJobDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id')->unsigned();
            $table->integer('estimate_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->string('item_description');
            $table->integer('units');
            $table->integer('quantity_issued')->default(0);
            $table->integer('balance_quantity')->nullable();
            $table->decimal('rate', 10, 2)->nullable();
            $table->decimal('labor_amount_final', 10, 2)->nullable();
            $table->decimal('initial_amount', 10, 2)->nullable();
            $table->decimal('approved_amount', 10, 2)->nullable();
            $table->string('task_status')->nullable();
            $table->timestamps();

            $table->foreign('job_id')->references('id')->on('jobs');
            $table->foreign('estimate_id')->references('id')->on('estimates');
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
        Schema::drop('job_details');
    }
}
