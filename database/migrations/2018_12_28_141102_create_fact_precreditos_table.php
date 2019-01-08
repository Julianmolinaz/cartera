<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactPrecreditosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fact_precreditos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('precredito_id')->unsigned();
            $table->string('num_fact')->unique();
            $table->date('fecha');
            $table->double('total');
            $table->enum('tipo',['Efectivo','Consignación']);
            $table->integer('user_create_id')->unsigned();
            $table->integer('user_update_id')->unsigned();

            $table->foreign('precredito_id')->references('id')->on('precreditos');
            $table->foreign('user_create_id')->references('id')->on('users');
            $table->foreign('user_update_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fact_precreditos');
    }
}
