<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soat', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned()->nullable();
            $table->integer('codeudor_id')->unsigned()->nullable();
            $table->string('placa')->nullable();
            $table->enum('tipo',['cliente','codeudor']);
            $table->date('vencimiento');
            $table->integer('user_create_id')->unsigned();
            $table->integer('user_update_id')->unsigned();

            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('codeudor_id')->references('id')->on('codeudores');
            $table->foreign('user_create_id')->references('id')->on('users');
            $table->foreign('user_update_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('soat');
    }
}
