<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiales', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('codigo_material', 10);
            $table->float('existencia_minima')->default(1.0);
            $table->integer('unidad_medida_id')->unsigned();
            $table->integer('tipo_material_id')->unsigned();
            $table->date('fecha_ingreso_material');
            $table->string('nombre_material', 150);
            $table->enum('estado_material' , ['ACTIVO', 'ELIMINADO'])->default('ACTIVO');

            $table->index(['codigo_material', 'estado_material']);

            $table->foreign('unidad_medida_id')->references('id')
                    ->on('unidades_medida')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('tipo_material_id')->references('id')
                    ->on('tipos_material')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materiales');
    }
}
