<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistribuidoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribuidores', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre_distribuidor', 150);
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->integer('ciudad_id')->unsigned()->default(1);
            $table->char('codigo_distribuidor', 4);
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
        Schema::dropIfExists('distribuidores');
    }
}
