<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiquidacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('persona_id')->unsigned();
            $table->float('dias_trabajados');
            $table->date('fecha_retiro');


            $table->float('porcentaje_intereses')->default(0);
            $table->float('total_cesantias');
            $table->float('total_vacaciones');
            $table->float('total_liquidacion')->default(0);
            $table->float('total_prima');
            $table->integer('dias_liquidacion');

            $table->enum('razon_retiro', [
                    'ENFERMEDAD',
                    'DESPIDO',
                    'VOLUNTARIO',
                    'FIN_CONTRATACION'
                ]);

            $table->foreign('persona_id')->references('id')
                    ->on('personas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('liquidaciones');
    }
}
