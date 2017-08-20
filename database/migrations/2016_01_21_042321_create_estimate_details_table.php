<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstimateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimate_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('estimate_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->string('item_description');
            $table->integer('units');
            $table->integer('quantity_issued')->default(0);
            $table->integer('balance_quantity');
            $table->decimal('rate', 10, 2);
            $table->decimal('labor_amount_final', 10, 2);
            $table->decimal('initial_amount', 10, 2);
            $table->decimal('approved_amount', 10, 2);
            $table->string('task_status');
            $table->timestamps();
            
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
        Schema::drop('estimate_details');
    }
}
