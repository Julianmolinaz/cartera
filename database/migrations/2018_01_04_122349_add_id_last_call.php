<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdLastCall extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('creditos', function (Blueprint $table) {
            $table->integer('last_llamada_id')->unsigned()->nullable();

            $table->foreign('last_llamada_id')
                ->references('id')->on('llamadas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('creditos', function (Blueprint $table) {
            //
        });
    }
}
