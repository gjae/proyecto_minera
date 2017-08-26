<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSegurosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguros', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre_seguro', 200);
            $table->string('codigo_seguro', 8);
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('razon_social', 110)->nullable();
            
            $table->tinyInteger('edo_seguro')->default(1);

            $table->index(['codigo_seguro']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seguros');
    }
}
