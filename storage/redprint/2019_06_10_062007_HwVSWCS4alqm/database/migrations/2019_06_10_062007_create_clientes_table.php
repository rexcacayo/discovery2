<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
			$table->string('fecha')->nullable();
			$table->string('nombreSr')->nullable();
			$table->string('cedulaSr')->nullable();
			$table->string('edadSr')->nullable();
			$table->string('ocupacionSr')->nullable();
			$table->string('nombreSra')->nullable();
			$table->string('cedulaSra')->nullable();
			$table->string('edadSra')->nullable();
			$table->string('ocupacionSra')->nullable();
			$table->string('estadoCivil')->nullable();
			$table->string('ingreso')->nullable();
			$table->string('telCasa')->nullable();
			$table->string('direccion')->nullable();
			$table->string('correo')->nullable();
			$table->string('lugaresContactaron')->nullable();
			$table->string('propiedad')->nullable();
			$table->string('opc')->nullable();
			$table->string('liner')->nullable();
			$table->string('hostess')->nullable();
			$table->string('cvs');
			$table->timestamps();
			$table->softdeletes();
			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
