<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned()->nullable();
            $table->integer('codeudor_id')->unsigned()->nullable();
            $table->integer('funcionario_id')->unsigned()->nullable();
            $table->integer('estDatacredito_id')->unsigned()->nullable();
            $table->integer('estLaboral_id')->unsigned()->nullable();
            $table->integer('estVivienda_id')->unsigned()->nullable();
            $table->integer('estReferencia_id')->unsigned()->nullable();
            $table->double('cal_asesor')->nullable();
            $table->double('cal_estudio')->nullable();
            $table->longText('observaciones')->nullable();
            $table->integer('user_create_id')->unsigned();
            $table->integer('user_update_id')->unsigned();
            $table->timestamps();

            $table->foreign('cliente_id')
                ->references('id')->on('clientes');

            $table->foreign('codeudor_id')
                ->references('id')->on('codeudores');

            $table->foreign('funcionario_id')
                ->references('id')->on('users');

            $table->foreign('estDatacredito_id')
                ->references('id')->on('est_datacreditos');

            $table->foreign('estLaboral_id')
                ->references('id')->on('est_laborales');

            $table->foreign('estVivienda_id')
                ->references('id')->on('est_viviendas');

            $table->foreign('estReferencia_id')
                ->references('id')->on('est_referencias');

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
        Schema::drop('estudios');
    }
}
