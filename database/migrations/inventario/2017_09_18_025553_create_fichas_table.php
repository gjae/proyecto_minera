<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFichasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('servicio', 150);
            $table->integer('ubicacion_id')->unsigned();
            $table->string('marca', 40);
            $table->string('modelo', 40);
            $table->string('serie', 15);
            $table->string('cedula_representante', 23);
            $table->string('representante', 160)->nullable();
            $table->integer('ciudad_representante')->unsigned();
            $table->string('telefono_representante', 25)->nullable();
            $table->char('anio_fabricacion', 4)->default('AAAA');
            $table->date('fecha_compra')->nullable();
            $table->date('fecha_instalacion')->nullable();
            $table->date('fecha_inicio_operaciones')->nullable();
            $table->integer('material_id')->unsigned();
            $table->integer('fabricante_id')->unsigned();
            $table->integer('distribuidor_id')->unsigned();

            $table->enum('tipo_adquisicion', [
                        'COMPRA',
                        'COMODATO',
                        'DONACION',
                        'CAMBIO',
                        'C/PAGO'
                    ])->default('COMPRA');

            $table->enum('tipo_mantenimiento', [
                    'PREVENTIVO',
                    'CORRECTIVO',
                    'PREDICTIVO'
                ])->default('PREDICTIVO');

            $table->enum('fuente_energia', [
                    'AGUA',
                    'GAS',
                    'ELECTRICIDAD',
                    'VAPOR',
                    'NUCLEAR',
                    'TERMICO',
                    'QUIMICO',
                    'BIOLOGICO',
                    'MECANICO'
                ])->default('ELECTRICIDAD');

            $table->enum('tipo_uso', [
                    'MEDICO',
                    'APOYO',
                    'BASICO'
                ])->default('BASICO');

            $table->enum('equipo', [
                    'MOVIL',
                    'FIJO'
                ])->default('FIJO');

            $table->enum('mantenimiento', ['PROPIO', 'CONTRATADO'])->default('PROPIO');

            $table->enum('calif_biomedica', [
                    'DIAGNOSTICO',
                    'TR/MANT-VID',
                    'PREVENCION',
                    'REHABILITACION',
                    'ANL/LABORATORIO',
                    'NINGUNO'
                ])->default('NINGUNO');

            $table->enum('tecn_predeterminada', [
                    'MECANICO',
                    'ELECTRICO',
                    'ELECTRONICO',
                    'HIDRAULICO',
                    'NEUMATICO'
                ])->default('MECANICO');

            $table->enum('tipo_riesgo', [
                    'III',
                    'IIB',
                    'IIA',
                    'I',
                    '-'
                ])->default('-');

            $table->float('voltaje')->default(0);
            $table->float('amperaje')->default(0);
            $table->float('potencia')->default(0);
            $table->enum('frecuencia', [
                    'ALTERNA',
                    'CONTINUA'
                ])->default('ALTERNA');

            $table->string('capacidad',  72)->nullable();
            $table->float('presion')->default(0);
            $table->float('vel')->default(0);
            $table->float('temperatura')->default(0);
            $table->float('peso')->default(0);
            $table->float('vida_util')->default(12);
            $table->float('valor')->default(0);
            $table->float('garantia')->default(12);

            $table->integer('frecuencia_mantenimiento')->defalt(12);
            $table->enum('manuales_componentes', [
                    'SI',
                    'NO'
                ])->default('SI');
            $table->enum('manuales_servicio', [
                    'SI',
                    'NO'
                ])->default('SI');
            $table->enum('manuales_usuario', [
                    'SI',
                    'NO'
                ])->default('SI');
            $table->enum('manuales_despiece', [
                    'SI',
                    'NO'
                ])->default('SI');
            $table->foreign('material_id')->references('id')
                    ->on('materiales')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('ubicacion_id')->references('id')
                    ->on('ubicaciones')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('fabricante_id')->references('id')
                    ->on('fabricantes')->onDelete('cascade')->onUpdate('cascade');


            $table->foreign('distribuidor_id')->references('id')
                    ->on('distribuidores')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fichas');
    }
}
