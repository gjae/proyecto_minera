<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            
            $table->enum('tipo_identificacion', ['NIT', 'CÉDULA_DE_EXTRANJERÍA', 'CÉDULA_DE_CIUDADANÍA'])->default('NIT');
            $table->enum('retenedor', ['SI', 'NO'])->default('SI');
            $table->enum('regimen_tributario', ['SIMPLIFICADO', 'COMUN'])->default('COMUN');
            $table->enum('tipo_cuenta', ['CORRIENTE', 'AHORRO'])->default('CORRIENTE');

            $table->string('telefono', 22)->nullable();
            $table->string('fax', 29)->nullable();
            $table->string('email', 190)->nullable();
            $table->string('cuenta_bancaria', 160)->nullable();
            $table->string('razon_social', 140);
            $table->string('representante_legal', 190);
            $table->string('cedula', 39);
            $table->string('nro_identificacion', 60); 
            $table->smallInteger('edo_reg')->default(1);

            $table->string('codigo_proveedor', 7);
            $table->text('direccion')->nullable();

            $table->integer('ciudad_id')->unsigned();
            $table->integer('banco_id')->unsigned();  

            $table->string('telefono_representante', 33)->nullable();
            $table->index(['cedula', 'nro_identificacion']);

            $table->string('email_representante', 33)->nullable();

            $table->foreign('ciudad_id')->references('id')
                    ->on('ciudades')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('banco_id')->references('id')
                    ->on('bancos')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedores');
    }
}
