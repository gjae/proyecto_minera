<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudCotizacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes_cotizacion', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('requisicion_id')->unsigned();
            $table->integer('proveedor_id')->unsigned();
            $table->text('concepto_solicitud');
            $table->enum('estado_registro', ['ACTIVA', 'ANULADA', 'PROCESADA'])->default('ACTIVA');
            $table->string('observacion_anulacion')->nullable();
            $table->string('codigo', 8);

            $table->index(['codigo']);
            $table->foreign('requisicion_id')->references('id')
                    ->on('requisiciones')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('proveedor_id')->references('id')
                    ->on('proveedores')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitudes_cotizacion');
    }
}
