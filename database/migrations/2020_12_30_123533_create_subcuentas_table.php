<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubcuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcuentas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('codigo');
            $table->integer('cuenta_id')->unsigned();
            $table->boolean('tercero')->default(false);
            $table->enum('tipo', ['Mayor','Movimiento'])->default('Movimiento');
            
            $table->foreign('cuenta_id')->references('id')->on('cuentas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
