<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('role_id')->unsigned();
            $table->decimal('rate', 10, 2)->nullable();
            $table->decimal('ot_rate', 10, 2)->nullable();
            $table->decimal('double_ot_rate', 10, 2)->nullable();
            $table->decimal('other', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('employee_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('employees');
    }
}
