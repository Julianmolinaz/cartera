<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clientes', function(Blueprint $table)
		{
			$table->increments('id');
			
			// info personal

			$table->string('nombre')->nullable();
			$table->string('primer_nombre', 60)->nullable();
			$table->string('segundo_nombre', 60)->nullable();
			$table->string('primer_apellido', 60)->nullable();
			$table->string('segundo_apellido', 60)->nullable();
			$table->enum('genero', ['Femenino','Masculino']);
			$table->enum('tipo_doc', [
				'Cedula Ciudadanía',
				'Nit',
				'Cedula de Extranjería',
				'Pasaporte',
				'Pase Diplomático',
				'Carnet Diplomático',
				'Tarjeta de Identidad',
				'Rut',
				'Número único de Identificación Personal',
				'Nit de Extranjería'
				])->default('Cedula Ciudadanía');
			$table->string('num_doc')->unique();
			$table->enum('estado_civil',[
				'Soltero/a',
				'Casado/a',
				'Separado/a',
				'Viudo/a',
				'Union libre',
				'Otro'
				])->nullable(); // new
			$table->date('fecha_exp')->nullable(); // new
			$table->string('lugar_exp')->nullable(); // new
			$table->string('fecha_nacimiento')->nullable();
			$table->string('lugar_nacimiento')->nullable(); // new
			$table->enum('nivel_estudios',[
				'Primaria',
				'Bachiller',
				'Tecnico',
				'Universitario',
				'Postgrado',
				'Ninguno'
				])->nullable(); // new

			//info ubicacion

			$table->string('direccion')->nullable();
			$table->string('barrio')->nullable();
            $table->string('movil');
            $table->integer('antiguedad_movil')->nullable()->comment('anitguedad en meses');
			$table->string('fijo')->nullable();
			$table->string('email')->nullable();
			$table->integer('anos_residencia')->nullable(); // new
			$table->enum('envio_correspondencia',['Casa','Empresa','Correo electronico'])->nullable(); // new
			$table->enum('estrato',[1,2,3,4,5,6])->nullable(); // new
			$table->integer('meses_residencia')->nullable(); // new
			$table->enum('tipo_vivienda',['Propia','Familiar','Alquilada'])->nullable(); // new
			$table->string('nombre_arrendador')->nullable(); // new
			$table->string('telefono_arrendador')->nullable(); // new
            
			// info laboral
            
			$table->enum('tipo_actividad', [ 'Dependiente','Independiente']);
			$table->string('ocupacion')->nullable()->comment('Guarda el string oficio de la tabla oficios');
			$table->string('empresa')->nullable()->comment('Nombre de la empresa');
			$table->string('dir_empresa')->nullable();
			$table->string('tel_empresa')->nullable();
			$table->string('cargo')->nullable();                    // new
			$table->string('descripcion_actividad')->nullable();    // new
			$table->string('doc_empresa')->nullable();              // new
			$table->date('fecha_vinculacion')->nullable();          // new
			$table->enum('tipo_contrato',['Indefinido','Prestacion de servicios','Termino fijo'])->nullable(); // new
            
            // info crediticia
            
            $table->enum('reportado', ['si','no'])->default('no'); // new
            $table->integer('numero_de_creditos')->nullable();
			$table->enum('calificacion', ['BB','B','M','MM','CASTIGADA'])->nullable();
            
            // referencias FK
            
            $table->integer('municipio_id')->unsigned()->nullable();
            $table->integer('codeudor_id')->unsigned()->nullable()->index('clientes_codeudor_id_foreign');
            $table->integer('conyuge_id')->unsigned()->nullable();
            $table->integer('user_create_id')->unsigned();
            $table->integer('user_update_id')->unsigned()->nullable();

			// general

			$table->string('placa')->nullable();
			$table->enum('version',['1','2','3'])->default(1)->comment('1-Gofin v1.0; 2-Gofin v2.0;3-Web2.0');
			$table->boolean('terminos')->nullable()->default(false)->comment('Aceptación de terminos y condiciones');
            
            $table->timestamps();
					
            $table->foreign('municipio_id')->references('id')->on('municipios');
            $table->foreign('codeudor_id')->references('id')->on('codeudores');
            $table->foreign('user_create_id')->references('id')->on('users');
            $table->foreign('conyuge_id')->references('id')->on('conyuges');
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
