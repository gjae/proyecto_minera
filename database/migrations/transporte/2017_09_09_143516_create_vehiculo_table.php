<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('placa', 22);
            $table->enum('tipo_vehiculo', ['CARGA', 'PARTICULAR', 'T_PERSONAL'])->default('PERSONAL');
            $table->date('fecha_adquisicion')->nullable();
            $table->float('capacidad_tanque')->default(0.0);
            $table->float('capacidad_carga')->default(0);
            $table->integer('cantidad_personas')->nullable();
            $table->smaillInteger('edo_reg')->default(1);
            $table->string('modelo', 193)->default('--');
            
            $table->string('marca')->nullable();
            $table->index(['placa']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculos');
    }
}
