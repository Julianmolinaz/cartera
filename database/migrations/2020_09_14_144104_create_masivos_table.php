<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masivos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha')->comment('Fecha del pago');
            $table->string('documento');
            $table->string('referencia')->nullable();
            $table->double('monto');
            $table->string('entidad');
            $table->boolean('efectivo')->default(false)->commet('true si se realizó el pago');
            $table->string('ref_type')->nullable()->comment('Referencia de la obligación, puede ser App\Credito o App\Precredito');
            $table->string('ref_id')->nullable()->comment('id de la obligación');
            $table->integer('ref_recibo_id')->comment('id del pago, si el ref_type es Precredito, el pago es por solicitud, si es Credito el pago es abono');
            $table->integer('load_id')->unsigned();

            $table->timestamps();

            $table->foreign('load_id')->references('id')->on('loads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('masivos');
    }
}
