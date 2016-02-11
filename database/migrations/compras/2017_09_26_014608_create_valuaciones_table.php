<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValuacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valuaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->char('codigo_valuacion', 4)->default('0000');
            $table->string('concepto_valuacion')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_tope')->nullable();

            /**
             * DESCRIPCION DE LOS ESTATUS:
             *     PE: PENDIENTE
             *     PA: PAGADO
             *     AN: ANULADO
             */
            $table->enum('estatus', ['PE', 'PA', 'AN'])->default('PE');

            $table->float('monto_valuacion')
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('valuaciones');
    }
}
