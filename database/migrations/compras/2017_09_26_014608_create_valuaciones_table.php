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
            $table->string('codigo_valuacion', 7)->default('0000000');
            $table->string('concepto_valuacion')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_tope')->nullable();
            $table->integer('orden_id')->unsigned();


            /**
             * DESCRIPCION DE LOS ESTATUS:
             *     PE: PENDIENTE
             *     PA: PAGADO
             *     AN: ANULADO
             */
            $table->enum('estatus', ['PE', 'PA', 'AN'])->default('PE');

            $table->float('monto_valuacion')->default(0);
            
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
        Schema::dropIfExists('valuaciones');
    }
}
