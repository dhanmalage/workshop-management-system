<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableInvoiceDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->string('item_description');
            $table->integer('units');
            $table->decimal('rate', 10, 2);
            $table->decimal('initial_amount', 10, 2);
            $table->decimal('approved_amount', 10, 2);
            $table->decimal('vat', 10, 2)->nullable();
            $table->decimal('nbt', 10, 2)->nullable();
            $table->decimal('vat_value', 10, 2)->nullable();
            $table->decimal('nbt_value', 10, 2)->nullable();			
            $table->decimal('pay_amount', 10, 2);
            $table->integer('detail_type');
            $table->timestamps();

            $table->foreign('invoice_id')->references('id')->on('invoices');
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
        Schema::drop('invoice_details');
    }
}
