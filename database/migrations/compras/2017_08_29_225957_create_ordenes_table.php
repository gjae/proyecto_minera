<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->enum('tipo_orden', ['COMPRA', 'SERVICIOS'])->default('COMPRA');
            $table->enum('estado_orden', ['EMITIDA', 'APROBADA', 'ANULADA', 'ELIMINADA'])->default('EMITIDA');
            $table->integer('analisis_id')->unsigned();
            $table->string('concepto')->nullable();
            $table->string('codigo_orden', 10);


            $table->index(['codigo_orden']);
            $table->foreign('analisis_id')->references('id')
                    ->on('analisis_cotizacion')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenes');
    }
}
