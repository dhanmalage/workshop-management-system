<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->integer('vehicle_id')->unsigned();
            $table->string('invoice_type')->nullable();
            $table->decimal('net_amount', 10 , 2);
            $table->decimal('vat_value', 10 , 2);
            $table->decimal('nbt_value', 10 , 2);
			$table->decimal('vat_total', 10, 2)->nullable();
			$table->decimal('nbt_total', 10, 2)->nullable();
            $table->text('remarks')->nullable();
            $table->integer('created_by')->unsigned();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
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
        Schema::drop('direct_invoices');
    }
}
