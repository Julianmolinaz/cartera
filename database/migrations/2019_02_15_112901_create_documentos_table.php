<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('ruta');
            $table->integer('cliente_id')->unsigned()->nullable();
            $table->integer('precredito_id')->unsigned()->nullable();
            $table->integer('credito_id')->unsigned()->nullable();
            $table->integer('user_create_id')->unsigned();

            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('precredito_id')->references('id')->on('precreditos');
            $table->foreign('credito_id')->references('id')->on('creditos');
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
        Schema::drop('documentos');
    }
}
