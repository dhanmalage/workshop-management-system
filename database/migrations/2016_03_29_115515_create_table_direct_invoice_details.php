<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDirectInvoiceDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_invoice_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('direct_invoice_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->string('item_description');
            $table->integer('units');
            $table->decimal('rate', 10, 2);
            $table->decimal('initial_amount', 10, 2);
            $table->decimal('vat', 10, 2)->nullable();
            $table->decimal('nbt', 10, 2)->nullable();
			$table->decimal('vat_value', 10, 2)->nullable();
            $table->decimal('nbt_value', 10, 2)->nullable();
            $table->decimal('pay_amount', 10, 2);
            $table->timestamps();

            $table->foreign('direct_invoice_id')->references('id')->on('direct_invoices');
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
        Schema::drop('direct_invoice_details');
    }
}
