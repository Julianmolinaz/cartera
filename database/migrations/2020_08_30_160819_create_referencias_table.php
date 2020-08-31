<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referencias',
         function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->enum('parentesco', [
                'Padre',
                'Madre',
                'Hijo/a',
                'Hermano/a',
                'Abuelo/a',
                'Tio/a',
                'Sobrino/a',
                'Nieto/a',
                'Suegro/a',
                'Yerno',
                'Nuera',
                'Cuñado',
                'Primo/a',
                'Amigo/a'
                ]);
                
            $table->string('direccion')->nullable();
            $table->string('celular')->nullable();
            $table->longText('observaciones')->nullable();
            
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');

            $table->integer('user_create_id')->unsigned();
            $table->foreign('user_create_id')->references('id')->on('users');

            $table->integer('user_update_id')->unsigned()->nullable();
            $table->foreign('user_update_id')->references('id')->on('users');

            $table->boolean('efectivo')->default(false);

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
        Schema::dropIfExists('referencias');
    }
}
