<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistroCotizacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_cotizacion', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('solicitud_cotizacion_id')->unsigned();
            $table->integer('material_id')->unsigned();
            $table->integer('proveedor_id')->unsigned();
            $table->integer('plazo_entrega')->default(0);
            $table->text('observacion')->nullable();

            $table->enum('estado_registro', ['REGISTRO', 'ANULADO', 'PROCESADO'])->default('REGISTRO');
            $table->string('observacion_anulacion')->nullable();
            $table->enum('forma_pago', ['CONTADO', 'CREDITO', 'CHEQUE', 'CARTA_DE_CREDITO', 'ABONO_A_CUENTA', 'OTROS'])->default('CONTADO');
            $table->enum('terminos_entrega', ['NUEVO', 'USADO', 'REPARADO'])->default('NUEVO');

            $table->float('cotizacion')->default(0);
            $table->float('porcentaje_impuesto')->default(0);
            $table->integer('cantidad')->default(0);
            $table->float('total_cotizacion')->default(0);

            $table->foreign('solicitud_cotizacion_id')->references('id')
                    ->on('solicitudes_cotizacion')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('material_id')->references('id')
                    ->on('materiales')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('registro_cotizacion');
    }
}
