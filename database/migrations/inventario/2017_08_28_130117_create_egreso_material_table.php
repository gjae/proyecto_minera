<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEgresoMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('egresos_materiales', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('material_id')->unsigned();
            $table->integer('cantidad_salida')->default(0);


            $table->integer('diciplina_id')->unsigned();
            $table->integer('centro_costo_id')->unsigned();
            $table->integer('etapa_produccion_id')->unsigned();
            $table->integer('persona_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('egresos_materiales');
    }
}
