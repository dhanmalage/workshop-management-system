<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id')->unsigned();
            $table->decimal('insurance_pay', 10, 2)->nullable();
            $table->decimal('customer_pay', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->decimal('vat_value', 10, 2);
            $table->decimal('nbt_value', 10, 2);
			$table->decimal('vat_total', 10, 2)->nullable();
			$table->decimal('nbt_total', 10, 2)->nullable();
            $table->decimal('total_pay', 10, 2)->nullable();
            $table->text('remark')->nullable();
            $table->string('customer_name');
            $table->string('customer_address');
            $table->string('customer_telephone')->nullable();
            $table->string('customer_mobile')->nullable();
            $table->string('customer_fax')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('insurance_company')->nullable();
            $table->string('insurance_address')->nullable();
            $table->string('insurance_vat_no')->nullable();
            $table->string('vehicle_reg')->nullable();
            $table->string('vehicle_make')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->string('vehicle_chasis')->nullable();
            $table->string('vehicle_mileage')->nullable();
            $table->integer('created_by')->unsigned();
            $table->timestamps();

            $table->foreign('job_id')->references('id')->on('jobs');
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
        Schema::drop('invoices');
    }
}
