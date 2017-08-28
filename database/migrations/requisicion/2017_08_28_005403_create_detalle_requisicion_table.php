<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleRequisicionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_requisicion', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('material_id');
            $table->integer('requisicion_id')->unsigned();
            $table->integer('servicio_id');
            $table->float('precio_estimado')->nullable();
            $table->float('porcentaje_impuesto')->nullable();
            $table->integer('cantidad_pedida')->default(0);
            $table->integer('cantidad_aprobada')->default(0);
            $table->float('total_material')->default(0.00);

            $table->foreign('requisicion_id')->references('id')
                ->on('requisiciones')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalles_requisicion');
    }
}
