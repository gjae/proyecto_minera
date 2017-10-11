<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialMinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiales_minas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('descripcion', 120);
            $table->integer('unidad_medida_id')->unsigned();
            $table->softDeletes();
            $table->integer('tipo_material_id')->unsigned();

            $table->foreign('unidad_medida_id')->references('id')
                    ->on('unidades_medida')->onDelete('cascade');

            $table->foreign('tipo_material_id')->references('id')
                    ->on('tipos_material')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materiales_minas');
    }
}
