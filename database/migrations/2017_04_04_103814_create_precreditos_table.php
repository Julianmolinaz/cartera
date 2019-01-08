<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrecreditosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precreditos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num_fact')->unique();
            $table->string('fecha');
            $table->integer('cartera_id')->unsigned();
            $table->integer('funcionario_id')->unsigned();
            $table->integer('cliente_id')->unsigned();
            $table->integer('producto_id')->unsigned();
            $table->double('vlr_fin');
            $table->enum('periodo',['Quincenal','Mensual']);
            $table->integer('meses');
            $table->integer('cuotas');
            $table->double('vlr_cuota');
            $table->string('p_fecha');
            $table->string('s_fecha')->nullable();            
            $table->enum('estudio',['Tipico','Domicilio','Sin estudio']);
            $table->double('cuota_inicial')->nullable();
            $table->enum('aprobado',['Si','No','En estudio','Desistio']);
            $table->longText('observaciones')->nullable();
            $table->integer('user_create_id')->unsigned();
            $table->integer('user_update_id')->unsigned();
            $table->timestamps();

            $table->foreign('cartera_id')
                ->references('id')->on('carteras');


            $table->foreign('funcionario_id')
                ->references('id')->on('users');


            $table->foreign('cliente_id')
                ->references('id')->on('clientes');


            $table->foreign('producto_id')
                ->references('id')->on('productos');


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
        Schema::drop('precreditos');
    }
}
