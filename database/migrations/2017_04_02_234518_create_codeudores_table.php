<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeudoresTable extends Migration
{

/*
|--------------------------------------------------------------------------
| datos
|--------------------------------------------------------------------------
|
| codeudor [si, no] => se exige codeudor o no
| nombrec           => nombre del codeudor
| primer_nombrec
| segundo_nombreC
| primer_apellidoc
| segundo_apellidoc
| tipo_docc 
| num_doc
| movilc
| fijoc
| direccionc
| 
|
|

*/




    public function up()
    {
        Schema::create('codeudores', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('codeudor',['si','no']);
            $table->string('nombrec');

            $table->string('primer_nombrec','60')->nullable();
            $table->string('segundo_nombrec','60')->nullable();
            $table->string('primer_apellidoc','60')->nullable();
            $table->string('segundo_apellidoc','60')->nullable();

            $table->enum('tipo_docc',[
               'Cedula Ciudadanía',
               'Nit',
               'Cedula de Extranjería',
               'Pasaporte',
               'Pase Diplomático',
               'Carnet Diplomático',
               'Tarjeta de identidad',
               'Rut',
               'Número unico de identificación personal',
               'Nit de extranjería'])
            ->default('Cedula Ciudadanía');

            $table->string('num_docc');
            $table->string('fecha_nacimientoc')->nullable();

            $table->string('direccionc')->nullable();
            $table->string('barrioc')->nullable();
            $table->integer('municipioc_id')->unsigned()->nullable();
        
            $table->string('movilc');
            $table->string('fijoc')->nullable();

            $table->string('ocupacionc')->nullable();
            $table->string('empresac')->nullable();
            $table->enum('tipo_actividadc',['Dependiente','Independiente'])->nullable();

            $table->string('emailc')->nullable();
            $table->string('placac')->nullable();

            $table->timestamps();

            $table->foreign('municipioc_id')
                ->references('id')->on('municipios');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('codeudores');
    }
}
