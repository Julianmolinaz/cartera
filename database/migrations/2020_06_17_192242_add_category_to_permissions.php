<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryToPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->enum('status', ['Activo','Inactivo'])->default('Activo');
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unisgned()->nullable();
            $table->string('category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('category');
            $table->dropColumn('status');
            $table->dropColumn('updated_by');
            $table->dropColumn('created_by');
        });
    }
}
