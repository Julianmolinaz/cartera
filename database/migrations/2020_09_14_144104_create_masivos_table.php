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
            $table->string('ref_type')->nullable();
            $table->string('ref_id')->nullable();
            $table->integer('created_by')->unsigned();
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
        Schema::drop('masivos');
    }
}
