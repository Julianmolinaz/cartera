<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRecordatorioToCreditosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('creditos', function (Blueprint $table) {
            $table->longText('recordatorio')->nullable();
        });
    }

    public function down()
    {
        Schema::table('creditos', function (Blueprint $table) {
            //
        });
    }
}
