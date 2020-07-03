	<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRefProductosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ref_productos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nombre', 100);
			$table->enum('estado', array('Procesando','Pagado'))->nullable()->default('Procesando');
			$table->date('fecha_exp')->nullable();
			$table->integer('precredito_id');
			$table->float('costo', 10, 0)->nullable();
			$table->float('iva', 10, 0)->nullable();
			$table->string('num_fact', 60)->nullable();
			$table->integer('proveedor_id')->nullable();
			$table->integer('producto_id');
			$table->text('extra')->nullable();
			$table->text('observaciones', 65535);
			$table->integer('created_by');
			$table->integer('updated_by')->nullable();
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
		Schema::drop('ref_productos');
	}

}
