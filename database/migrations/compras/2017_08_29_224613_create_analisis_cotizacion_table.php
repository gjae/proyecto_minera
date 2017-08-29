<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalisisCotizacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analisis_cotizacion', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('registro_cotizacion_id')->unsigned();
            $table->integer('proveedor_id')->unsigned();
            $table->string('observacion')->nullable();
            $table->string('codigo', 8);
            $table->enum('estado_analisis', ['REGISTRADO', 'ANULADO', 'APROBADO'])->default('REGISTRADO');

            $table->index(['codigo']);

            $table->foreign('proveedor_id')->references('id')
                    ->on('proveedores')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('registro_cotizacion_id')->references('id')
                    ->on('registro_cotizacion')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('analisis_cotizacion');
    }
}
