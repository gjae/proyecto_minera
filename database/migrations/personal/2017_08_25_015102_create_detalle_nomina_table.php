<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleNominaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_nomina', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('persona_id')->unsigned();
            $table->integer('ajuste_persona_id')->unsigned();
            $table->integer('nomina_id')->unsigned();
            $table->float('total_bonos')->default(0);
            $table->float('total_deducciones')->default(0);
            $table->float('total_pagar')->default(0);

            $table->foreign('persona_id')->references('id')
                    ->on('personas')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('ajuste_persona_id')->references('id')
                    ->on('ajuste_personas')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('nomina_id')->references('id')
                    ->on('nominas')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_nomina');
    }
}
