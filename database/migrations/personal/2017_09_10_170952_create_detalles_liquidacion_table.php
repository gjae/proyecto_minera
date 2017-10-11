<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallesLiquidacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_liquidacion', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('liquidacion_id')->unsigned();
            $table->integer('ajuste_persona_id')->unsigned();

            $table->float('total_ajuste');

            $table->foreign('ajuste_persona_id')->references('id')
                    ->on('ajuste_personas')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('liquidacion_id')->references('id')
                    ->on('liquidaciones')
                    ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalles_liquidacion');
    }
}
