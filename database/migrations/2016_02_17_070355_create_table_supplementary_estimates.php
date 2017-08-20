<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSupplementaryEstimates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplementary_estimates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('estimate_id')->unsigned();
            $table->decimal('net_amount', 10, 2);
            $table->integer('created_by')->unsigned();
            $table->timestamps();

            $table->foreign('estimate_id')->references('id')->on('estimates');
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
        Schema::drop('supplementary_estimates');
    }
}
