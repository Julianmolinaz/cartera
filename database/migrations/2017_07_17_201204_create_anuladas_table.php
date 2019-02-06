<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnuladasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anuladas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned();
            $table->integer('factura_id');
            $table->integer('credito_id')->unsigned()->nullable();
            $table->integer('precredito_id')->unsigned()->nullable();
            $table->string('num_fact');
            $table->string('fecha');
            $table->double('total');
            $table->longText('pagos')->nullable();
            $table->text('motivo_anulacion')->nullable();
            $table->integer('user_anula')->unsigned();
            $table->integer('user_create_id')->unsigned();
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('credito_id')->references('id')->on('creditos');
            $table->foreign('user_anula')->references('id')->on('users');
            $table->foreign('user_create_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('anuladas');
    }
}
