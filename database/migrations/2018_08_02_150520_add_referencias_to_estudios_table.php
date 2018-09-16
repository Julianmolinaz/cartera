<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReferenciasToEstudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estudios', function (Blueprint $table) {
            $table->longText('ref_1')->nullable();
            $table->longText('ref_2')->nullable();
            $table->longText('ref_3')->nullable();
            $table->longText('ref_4')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estudios', function (Blueprint $table) {
            $table->dropColumn(['ref_1','ref_2','ref_3','ref_4']);
        });
    }
}
