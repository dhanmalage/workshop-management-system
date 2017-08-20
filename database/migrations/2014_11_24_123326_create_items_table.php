<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('type')->nullable();
            $table->string('location')->nullable();
            $table->decimal('quantity', 10, 2)->nullable();
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->string('unit_of_sale')->nullable();
            $table->decimal('pre_order_level', 10, 2)->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->decimal('actual_cost', 10, 2)->nullable();
            $table->decimal('service_only_cost', 10, 2)->nullable();
            $table->integer('vat')->unsigned()->default(0);
            $table->integer('nbt')->unsigned()->default(0);
            $table->integer('created_by')->unsigned();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('item_categories');
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
        Schema::drop('items');
    }
}
