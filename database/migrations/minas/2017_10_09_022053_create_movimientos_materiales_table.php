<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientosMaterialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos_materiales', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();

            $table->float('cantidad_ingreso')->default(0);
            $table->float('cantidad_salida')->default(0);

            $table->float('monto_tonelada')->default(0);
            $table->float('total_movimiento')->default(0);

            $table->date('fecha_ingreso')->nullable();
            $table->date('fecha_salida')->nullable();

            $table->string('observacion');

            $table->enum('peso_en',[
                    'KG',
                    'TON',
                    'GR'
                ])->default('TON');


            /**
             * PERSONA (MINERO) RESPONSABLE
             */
            $table->integer('persona_id')->unsigned();

            $table->integer('material_mina_id')->unsigned();

            $table->integer('mina_id')->unsigned();

            $table->integer('centro_costo_id')->unsigned();
            $table->integer('diciplina_id')->unsigned();
            $table->integer('etapa_produccion_id')->unsigned();

            $table->foreign('persona_id')->references('id')
                    ->on('personas')->onDelete('cascade');

            $table->foreign('material_mina_id')->references('id')
                    ->on('materiales_minas')->onDelete('cascade');

            $table->foreign('mina_id')->references('id')
                    ->on('minas')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimientos_materiales');
    }
}
