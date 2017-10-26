<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('factura_id')->unsigned();
            $table->integer('credito_id')->unsigned();
            $table->enum('concepto',['Cuota','Cuota Parcial','Mora','Prejuridico','Juridico','Saldo a Favor']);
            $table->double('abono');
            $table->double('debe');
            $table->longText('descripcion')->nullable();
            $table->enum('estado',['Debe','Ok','Finalizado']);
            $table->date('pago_desde')->nullable(); 
            $table->date('pago_hasta')->nullable();
            $table->string('abono_pago_id')->nullable();  

            $table->timestamps();

            $table->foreign('factura_id')
                ->references('id')->on('facturas');

            $table->foreign('credito_id')
                ->references('id')->on('creditos');      

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pagos');
    }
}
