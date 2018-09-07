<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdicionalToCodeudoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('codeudores', function (Blueprint $table) {
            $table->integer('conyuge_id')->unsigned()->nullable();
            $table->string('dir_empresac')->nullable();
            $table->string('tel_empresac')->nullable();

            $table->foreign('conyuge_id')
                  ->references('id')
                  ->on('conyuges')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('codeudores', function (Blueprint $table) {
            $table->dropColumn(['conyuge_id','dir_empresa','tel_empresa']);
        });
    }
}
