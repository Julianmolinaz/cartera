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
			$table->enum('codeudor', array('si','no'));
			$table->string('nombrec');
			$table->string('primer_nombrec', 60)->nullable();
			$table->string('segundo_nombrec', 60)->nullable();
			$table->string('primer_apellidoc', 60)->nullable();
			$table->string('segundo_apellidoc', 60)->nullable();
			$table->enum('tipo_docc', array('Cedula Ciudadanía','Nit','Cedula de Extranjería','Pasaporte','Pase Diplomático','Carnet Diplomático','Tarjeta de identidad','Rut','Número unico de identificación personal','Nit de extranjería'))->default('Cedula Ciudadanía');
			$table->string('num_docc');
			$table->string('fecha_nacimientoc')->nullable();
			$table->string('direccionc')->nullable();
			$table->string('barrioc')->nullable();
			$table->integer('municipioc_id')->unsigned()->nullable()->index('codeudores_municipioc_id_foreign');
			$table->string('movilc');
			$table->string('fijoc')->nullable();
			$table->string('ocupacionc')->nullable();
			$table->string('empresac')->nullable();
			$table->enum('tipo_actividadc', array('Dependiente','Independiente'))->nullable();
			$table->string('emailc')->nullable();
			$table->string('placac')->nullable();
			$table->string('dir_empresac')->nullable();
			$table->string('tel_empresac')->nullable();
			$table->integer('conyuge_id')->unsigned()->nullable()->index('codeudores_conyuge_id_foreign');
			$table->timestamps();

			$table->foreign('conyuge_id', 'codeudores_conyugec_id_foreign')->references('id')->on('conyuges')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('municipioc_id')->references('id')->on('municipios')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
