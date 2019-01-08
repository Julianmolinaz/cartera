<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->nullable();
            $table->string('primer_nombre','60')->nullable();
            $table->string('segundo_nombre','60')->nullable();
            $table->string('primer_apellido','60')->nullable();
            $table->string('segundo_apellido','60')->nullable();

            $table->enum('tipo_doc',[
               'Cedula Ciudadanía',
               'Nit',
               'Cedula de Extranjería',
               'Pasaporte',
               'Pase Diplomático',
               'Carnet Diplomático',
               'Tarjeta de Identidad',
               'Rut',
               'Número único de Identificación Personal',
               'Nit de Extranjería'])
            ->default('Cedula Ciudadanía');

            $table->string('num_doc')->unique();
            $table->string('fecha_nacimiento')->nullable();
            $table->string('direccion')->nullable();
            $table->string('barrio')->nullable();
            $table->integer('municipio_id')->unsigned()->nullable();
            $table->string('movil');
            $table->string('fijo')->nullable();
            $table->string('email')->nullable();
            $table->string('placa')->nullable();

            $table->string('ocupacion')->nullable();
            $table->string('empresa')->nullable();
            $table->enum('tipo_actividad',['Dependiente','Independiente']);

            $table->integer('codeudor_id')->unsigned()->nullable();
            $table->integer('numero_de_creditos')->nullable();
            $table->integer('user_create_id')->unsigned();
            $table->integer('user_update_id')->unsigned()->nullable();

            //Columnas creadas para el reporte de centrales de riesgo

            $table->enum('calificacion',['BB','B','M','MM','CASTIGADA'])->nullable();
            
            $table->timestamps();

            $table->foreign('municipio_id')->references('id')->on('municipios');
            $table->foreign('codeudor_id')->references('id')->on('codeudores');
            $table->foreign('user_create_id')->references('id')->on('users');  
            $table->foreign('user_update_id')->references('id')->on('users');  
 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clientes');
    }
}
