<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEgresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('egresos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('punto_id')->unsigned()->nullable();
            $table->string('fecha');
            $table->string('comprobante_egreso');
            $table->enum('concepto',
                ['Anulado','Asistimotos','Bancos','Cartera de terceros','Comisión','Compras','Consultar','Financiero','Gastos',
                 'Jurídico','Libre inversión','Nómina','Operativo','Pago a proveedores',
                 'Prestamos','Publicidad','Tarjetas de crédito']);
            $table->double('valor');
            $table->text('observaciones')->nullable();
            $table->integer('cartera_id')->unsigned();
            $table->integer('user_create_id')->unsigned();
            $table->integer('user_update_id')->unsigned();
            $table->timestamps();


            $table->foreign('cartera_id')
                ->references('id')->on('carteras');

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
        Schema::drop('egresos');
    }
}
