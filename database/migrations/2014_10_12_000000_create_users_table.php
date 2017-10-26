<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('estado',['Activo','Inactivo'])->default('Activo');
            $table->enum('rol',['Administrador','Asesor','Asesor VIP','Recaudador','Call']);
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('punto_id')->unsigned();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('punto_id')->references('id')->on('puntos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
