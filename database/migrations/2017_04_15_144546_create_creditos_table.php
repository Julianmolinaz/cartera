<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creditos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('precredito_id')->unsigned();
            $table->integer('cuotas_faltantes');
            $table->double('saldo')->nullable();
            $table->double('saldo_favor')->nullable();
            $table->enum('estado',['Al dia','Mora','Prejuridico','Juridico','Cancelado','Cancelado por refinanciacion']);
            $table->double('rendimiento');
            $table->double('valor_credito');
            $table->enum('castigada',['Si','No'])->nullable();
            $table->enum('refinanciacion',['Si','No'])->default('No');
            $table->integer('end_procredito');
            $table->integer('end_datacredito');
            $table->integer('user_create_id')->unsigned();
            $table->integer('user_update_id')->unsigned();
            $table->timestamps();

            $table->foreign('precredito_id')
                ->references('id')->on('precreditos');

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
        Schema::drop('creditos');
    }
}
