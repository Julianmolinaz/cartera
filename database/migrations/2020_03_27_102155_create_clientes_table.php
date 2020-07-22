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
			$table->enum('genero', array('Femenino','Masculino'));
			$table->enum('tipo_doc', array('Cedula Ciudadanía','Nit','Cedula de Extranjería','Pasaporte','Pase Diplomático','Carnet Diplomático','Tarjeta de Identidad','Rut','Número único de Identificación Personal','Nit de Extranjería'))->default('Cedula Ciudadanía');
			$table->string('num_doc')->unique();
			$table->string('ciudad_exp')->nullable(); // new
			$table->enum('estado_civil',['Soltero/a','Casado/a','Separado/a','Viudo/a','Union libre','Otro'])->nullable(); // new
			$table->date('fecha_exp')->nullable(); // new
			$table->string('lugar_exp')->nullable(); // new
			$table->string('fecha_nacimiento')->nullable();
			$table->string('lugar_nacimiento')->nullable(); // new
			$table->enum('nivel_estudios',['Primaria','Bachiller','Tecnico','Universitario','Postgrado','Ninguno'])->nullable(); // new


			//info ubicacion

			$table->string('direccion')->nullable();
			$table->string('barrio')->nullable();
			$table->integer('municipio_id')->unsigned()->nullable();
			$table->string('movil');
			$table->string('antiguedad_movil');
			$table->string('fijo')->nullable();
			$table->string('email')->nullable();
			$table->integer('anos_residencia')->nullable(); // new
			$table->enum('envio_correspondencia',['Casa','Empresa','Correo electronico'])->nullable(); // new
			$table->enum('estrato',[1,2,3,4,5,6])->nullable(); // new
			$table->integer('meses_residencia')->nullable(); // new
			$table->enum('tipo_vivienda',['Propia','Familiar','Alquilada'])->nullable(); // new
			$table->string('nombre_arrendador')->nullable(); // new
			$table->string('telefono_arrendador')->nullable(); // new

			//info economica

			$table->string('ocupacion')->nullable();
			$table->string('empresa')->nullable();
			$table->string('nit');
			$table->enum('tipo_actividad', array('Dependiente','Independiente'));
			$table->string('dir_empresa')->nullable();
			$table->string('tel_empresa')->nullable();@
			$table->string('cargo')->nullable(); // new
			$table->string('descripcion_actividad')->nullable(); // new
			$table->string('doc_empresa')->nullable(); // new
			$table->date('fecha_vinculacion')->nullable(); // new
			$table->string('oficio')->nullable(); // new
			$table->enum('tipo_contrato',['Idefinido','Prestacion de servicios','Termino fijo'])->nullable(); // new
			$table->enum('reportado', array('si','no'));

			// referencias

			$table->integer('conyuge_id')->unsigned()->nullable();
			$table->integer('codeudor_id')->unsigned()->nullable()->index('clientes_codeudor_id_foreign');
			$table->integer('user_create_id')->unsigned();
			$table->integer('user_update_id')->unsigned()->nullable();
			$table->integer('cdeudor_id')->unsigned()->nullable()->comments('codeudor v2 que es realmente un cliente con rol de codeudor');

			// general
			$table->enum('tipo',['cliente','codeudor'])->default('Cliente');
			$table->integer('numero_de_creditos')->nullable();
			$table->enum('calificacion', array('BB','B','M','MM','CASTIGADA'))->nullable();
			$table->string('placa')->nullable();
			$table->timestamps();
			$table->enum('version', array('1','2','web'));

			// FK

			$table->foreign('codeudor_id')->references('id')->on('codeudores')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('conyuge_id')->references('id')->on('conyuges')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('municipio_id')->references('id')->on('municipios')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('user_create_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('user_update_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
