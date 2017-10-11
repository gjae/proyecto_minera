<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sitios_trabajo', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre_sitio', 130);
            $table->string('codigo_sitio', 8);
            $table->string('direccion_sitio')->nullable();
            $table->integer('ciudad_id')->unsigned();

          //  $table->index(['codigo_sitio']);
            $table->tinyInteger('edo_sitio')->default(1);

            $table->foreign('ciudad_id')->references('id')
                    ->on('ciudades')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sitios_trabajo');
    }
}
