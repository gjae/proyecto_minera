<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFabricantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fabricantes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre_fabricante');
            $table->integer('pais_id')->unsigned();
            $table->string('telefono',22)->unsigned();
            $table->string('codigo_fabricante', 5)->nullable();
            $table->smallInteger('edo_reg')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fabricantes');
    }
}
