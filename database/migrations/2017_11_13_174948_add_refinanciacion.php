<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRefinanciacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('creditos', function ($table) {

        $table->integer('credito_refinanciado_id')->unsigned()->nullable();

        $table->foreign('credito_refinanciado_id')
            ->references('id')->on('creditos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropColumn('credito_refinanciado_id');
    }
}
