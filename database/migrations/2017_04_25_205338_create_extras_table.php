<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fecha');
            $table->enum('concepto',['Prejuridico','Juridico']);
            $table->enum('estado',['Ok','Debe','Finalizado']);
            $table->double('valor');
            $table->longText('descripcion')->nullable();
            $table->integer('credito_id')->unsigned();
            $table->integer('user_create_id')->unsigned();
            $table->integer('user_update_id')->unsigned();
            $table->timestamps();

            $table->foreign('credito_id')
            ->references('id')->on('creditos');
            
            $table->foreign('user_create_id')
            ->references('id')->on('users');

            $table->foreign('user_update_id')
            ->references('id')->on('users');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('extras');
    }
}
