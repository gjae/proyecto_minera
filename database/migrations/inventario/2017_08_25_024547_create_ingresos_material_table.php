<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngresosMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingresos_material', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->date('fecha_ingreso');
            $table->integer('material_id')->unsigned();
            $table->float('cantidad')->default(0.00);


            $table->foreign('material_id')->references('id')
                    ->on('materiales')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingresos_material');
    }
}
