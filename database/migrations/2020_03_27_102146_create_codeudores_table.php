<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCodeudoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('codeudores', function(Blueprint $table)
		{
            $table->increments('id');
            
			$table->enum('codeudor', ['si','no'])->nullable(); // agregar nullable
			$table->string('nombrec')->nullable(); // agregar nullable
			$table->string('primer_nombrec', 60)->nullable(); 
			$table->string('segundo_nombrec', 60)->nullable();
			$table->string('primer_apellidoc', 60)->nullable();
			$table->string('segundo_apellidoc', 60)->nullable();
            $table->enum('tipo_docc', 
                [ 
                    'Cedula Ciudadanía',
                    'Nit',
                    'Cedula de Extranjería',
                    'Pasaporte',
                    'Pase Diplomático',
                    'Carnet Diplomático',
                    'Tarjeta de identidad',
                    'Rut',
                    'Número unico de identificación personal',
                    'Nit de extranjería'
                ])->nullable(); // eliminar el valor por default

			$table->string('num_docc')->nullable();
			$table->string('fecha_nacimientoc')->nullable();
			$table->string('direccionc')->nullable();
			$table->integer('municipioc_id')->unsigned()->nullable()->index('codeudores_municipioc_id_foreign');
            $table->foreign('municipioc_id')->references('id')->on('municipios')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->string('barrioc')->nullable();
			$table->string('movilc')->nullable(); 
			$table->string('fijoc')->nullable();
			$table->string('ocupacionc')->nullable();
			$table->string('empresac')->nullable();
			$table->enum('tipo_actividadc', array('Dependiente','Independiente'))->nullable();
			$table->string('emailc')->nullable();
			$table->string('placac')->nullable();
			$table->string('dir_empresac')->nullable();
            $table->string('tel_empresac')->nullable();
            
            //********* VERSION DOS DE CODEUDOR ************//

            // info personal

			$table->string('nombre')->nullable();
			$table->string('primer_nombre', 60)->nullable();
			$table->string('segundo_nombre', 60)->nullable();
			$table->string('primer_apellido', 60)->nullable();
			$table->string('segundo_apellido', 60)->nullable();
			$table->enum('genero', array('Femenino','Masculino'));
			$table->enum('tipo_doc', array('Cedula Ciudadanía','Nit','Cedula de Extranjería','Pasaporte','Pase Diplomático','Carnet Diplomático','Tarjeta de Identidad','Rut','Número único de Identificación Personal','Nit de Extranjería'))->default('Cedula Ciudadanía');
			$table->string('num_doc')->nullable();
			$table->enum('estado_civil',['Soltero/a','Casado/a','Separado/a','Viudo/a','Union libre','Otro'])->nullable(); 
			$table->date('fecha_exp')->nullable(); 
			$table->string('lugar_exp')->nullable(); 
			$table->string('fecha_nacimiento')->nullable();
			$table->string('lugar_nacimiento')->nullable(); 
			$table->enum('nivel_estudios',['Primaria','Bachiller','Tecnico','Universitario','Postgrado','Ninguno'])->nullable(); 

			//info ubicacion

			$table->string('direccion')->nullable();
			$table->string('barrio')->nullable();
            $table->string('movil')->nullable();
            $table->integer('antiguedad_movil')->nullable()->comment('anitguedad en meses');
			$table->string('fijo')->nullable();
			$table->string('email')->nullable();
			$table->integer('anos_residencia')->nullable(); 
			$table->enum('envio_correspondencia',['Casa','Empresa','Correo electronico'])->nullable(); 
			$table->enum('estrato',[1,2,3,4,5,6])->nullable(); 
			$table->integer('meses_residencia')->nullable(); 
			$table->enum('tipo_vivienda',['Propia','Familiar','Alquilada'])->nullable(); 
			$table->string('nombre_arrendador')->nullable(); 
			$table->string('telefono_arrendador')->nullable(); 
            
			// info laboral
            
			$table->enum('tipo_actividad', ['Dependiente','Independiente'])->nullable();
			$table->string('ocupacion')->nullable()->comment('Guarda el string oficio de la tabla oficios');
			$table->string('empresa')->nullable()->comment('Nombre de la empresa');
			$table->string('dir_empresa')->nullable();
			$table->string('tel_empresa')->nullable();
			$table->string('cargo')->nullable();                    
			$table->string('descripcion_actividad')->nullable();    
			$table->string('doc_empresa')->nullable();              
			$table->date('fecha_vinculacion')->nullable();          
			$table->enum('tipo_contrato',['Indefinido','Prestacion de servicios','Termino fijo'])->nullable(); 
            
            // info crediticia
            
            $table->enum('reportado', ['si','no'])->nullable();
            
            // referencias FK
            
            $table->integer('municipio_id')->unsigned()->nullable();
            $table->foreign('municipio_id')->references('id')->on('municipios')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            
            $table->integer('conyuge_id')->unsigned()->nullable();
            $table->foreign('conyuge_id')->references('id')->on('conyuges')->onUpdate('RESTRICT')->onDelete('RESTRICT');

            $table->integer('user_create_id')->unsigned()->nullable();
            $table->foreign('user_create_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');

            $table->integer('user_update_id')->unsigned()->nullable();
            $table->foreign('user_update_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');

            // general
            
			$table->enum('version',['1','2','3'])->default(1)->comment('1-Gofin v1.0; 2-Gofin v2.0;3-Web2.0');
            
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
		Schema::drop('codeudores');
	}

}
