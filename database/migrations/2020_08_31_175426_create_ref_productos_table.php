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
            $table->enum('expedido_a',['Cliente','Gora']);
			$table->enum('estado', ['En proceso','Liquidado'])->nullable()->default('En Proceso');
			$table->date('fecha_exp')->nullable();
			$table->float('costo', 10, 0)->nullable();
            $table->float('iva', 10, 0)->nullable();
			$table->string('num_fact', 60)->nullable();
			$table->float('otros', 10, 2)->nullable();
			$table->longText('observaciones')->nullable();
            $table->integer('qty')->default(1);
      
            // Referencias

            $table->integer('vehiculo_id')->unsigned();
            $table->integer('producto_id')->unsigned();
            $table->integer('proveedor_id')->unsigned();
            $table->integer('precredito_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->foreign('proveedor_id')->references('id')->on('terceros');
            $table->foreign('precredito_id')->references('id')->on('precreditos');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');

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
