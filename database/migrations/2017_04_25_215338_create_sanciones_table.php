<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSancionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('credito_id')->unsigned();
            $table->double('valor');
            $table->enum('estado',['Ok','Debe','Exonerada']);
            $table->integer('pago_id')->nullable();
            $table->timestamps();

            $table->foreign('credito_id')->references('id')->on('creditos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sanciones');
    }
}
