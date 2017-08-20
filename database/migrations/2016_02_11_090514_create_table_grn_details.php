<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGrnDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grn_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('grn_id')->unsigned();
            $table->integer('order_id');
            $table->integer('item_id')->unsigned();
            $table->string('item_description');
            $table->integer('quantity');
            $table->integer('quantity_in')->nullable();
            $table->string('status');
            $table->timestamps();

            $table->foreign('grn_id')->references('id')->on('grns');
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
        Schema::drop('grn_details');
    }
}
