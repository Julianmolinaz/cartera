<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_productos', function (Blueprint $table) {
            $table->integer('id', true);
			$table->string('nombre', 100);
			$table->enum('estado', ['En proceso','Liqudado'])->nullable()->default('En Proceso');
			$table->date('fecha_exp')->nullable();
			$table->float('costo', 10, 0)->nullable();
			$table->float('iva', 10, 0)->nullable();
			$table->string('num_fact', 60)->nullable();
			$table->text('extra')->nullable();
			$table->longText('observaciones')->nullable();
      
            // Referenciass

            $table->integer('vehiculo_id')->unsigned();
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');

            // $table->integer('proveedor_id')->unsigned();
            // $table->foreign('proveedor_id')->references('id')->on('terceros');

            $table->integer('producto_id')->unsigned();
            $table->foreign('producto_id')->references('id')->on('productos');
           
            $table->integer('proveedor_id')->unsigned();
            $table->foreign('proveedor_id')->references('id')->on('terceros');

            $table->integer('precredito_id')->unsigned();
            $table->foreign('precredito_id')->references('id')->on('precreditos');

            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');

            $table->integer('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users');

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
