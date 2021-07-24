<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEgresosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('egresos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('punto_id')->unsigned()->nullable();
			$table->string('fecha');
			$table->string('comprobante_egreso');
			$table->enum('concepto', array('Anulado','Asistimotos','Bancos','Cartera de terceros','Comisión','Compras','Compra de inmueble','Consignacion','Consultar','Financiero','Gastos','Jurídico','Libre inversión','Nómina','Operativo','Pago a proveedores','Prestamos','Publicidad','Tarjetas de crédito','Devoluciones','Unificaciones'));
			$table->integer('user_nomina_id')->unsigned()->nullable()->index('user_nomina_id');
			$table->integer('proveedor_id')->unsigned()->nullable()->index('proveedor_id');
			$table->enum('tipo', array('Efectivo','Consignacion'));
			$table->integer('banco_id')->unsigned()->nullable()->index('banco_id');
			$table->string('num_consignacion')->nullable();
			$table->float('valor', 10, 0);
			$table->text('observaciones', 65535)->nullable();
			$table->integer('cartera_id')->unsigned()->index('egresos_cartera_id_foreign');
			$table->integer('user_create_id')->unsigned();
			$table->integer('user_update_id')->unsigned()->nullable();
			$table->timestamps();

			$table->foreign('cartera_id')->references('id')->on('carteras')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
		Schema::drop('egresos');
	}

}
