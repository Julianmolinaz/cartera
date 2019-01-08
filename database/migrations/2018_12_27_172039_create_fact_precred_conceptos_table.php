<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactPrecredConceptosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fact_precred_conceptos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->enum('estado',['Activo','Inactivo'])->default('Activo');
            $table->double('valor')->nullable();
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
        Schema::drop('fact_precred_conceptos');
    }
}
