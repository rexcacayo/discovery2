<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcompanantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acompanantes', function (Blueprint $table) {
            $table->increments('id');
			$table->string('nombre');
			$table->string('cedula');
			$table->string('edad');
			$table->string('qsco');
			$table->string('ocupacion');
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
        Schema::dropIfExists('acompanantes');
    }
}
