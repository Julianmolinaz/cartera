<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagosTable extends Migration {

	
	public function up()
	{
		Schema::create('pagos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('factura_id')->unsigned()->index('pagos_factura_id_foreign');
			$table->integer('credito_id')->unsigned()->index('pagos_credito_id_foreign');
			$table->enum('concepto', array('Cuota','Cuota Parcial','Mora','Prejuridico','Juridico','Saldo a Favor'));
			$table->float('abono', 10, 0);
			$table->float('debe', 10, 0);
			$table->text('descripcion')->nullable();
			$table->enum('estado', array('Debe','Ok','Finalizado'));
			$table->date('pago_desde')->nullable();
			$table->date('pago_hasta')->nullable();
			$table->string('abono_pago_id')->nullable();
			$table->timestamps();

			$table->foreign('credito_id')->references('id')->on('creditos')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('factura_id')->references('id')->on('facturas')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}

	public function down()
	{
		Schema::drop('pagos');
	}

}
