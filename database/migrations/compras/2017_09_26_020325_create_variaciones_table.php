<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('consecutivo', 7)->default('0000000');
            $table->string('concepto', 150)->nullable();
            $table->float('monto_variacion')->default(0);
            $table->integer('cantidad_dias_variacion')->default(0);
            $table->date('fecha_suspencion')->nullable();
            $table->date('fecha_reinicio')->nullable();
            $table->integer('orden_id')->unsigned();

            /**
             * 1: PENDIENTE
             * 2: ANULADO
             */
            $table->smallInteger('estatus')->default(1);

            $table->foreign('orden_id')->references('id')
                    ->on('ordenes')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variaciones');
    }
}
