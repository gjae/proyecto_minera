<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAjustesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ajustes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre_ajuste', 100);
            $table->char('codigo_ajuste', 4);
            $table->float('porcentaje_ajuste')->default(0.00);
            $table->float('cantidad_ajuste')->default(0.00);
            $table->date('fecha_activdad_desde')->default('1900-01-01');
            $table->date('fecha_activdad_hasta')->default('1900-01-01');

            $table->enum('tipo_ajuste', ['DEDUCCION', 'BONO'])
                    ->default('DEDUCCION');

            $table->enum('ajuste_permanente', ['SI', 'NO'])
                    ->default('SI');

            $table->enum('ajuste_global', ['SI', 'NO'])
                    ->default('SI');
            $table->enum('aportador', ['PERSONA', 'PATRON'])
                    ->default('PERSONA');

         //   $table->index(['codigo_ajuste', 'ajuste_permanente', 'ajuste_global', 'aportador']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ajustes');
    }
}
