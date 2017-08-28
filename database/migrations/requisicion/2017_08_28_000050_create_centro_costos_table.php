<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentroCostosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centros_costos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre_centro');
            $table->string('codigo_centro', 8)->nullable();

            $table->index(['codigo_centro']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('centros_costos');
    }
}
