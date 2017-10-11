<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('identificacion', 89);
            $table->date('fecha_ingreso');

            $table->string('primer_nombre', 22)->nullable();
            $table->string('segundo_nombre', 22)->nullable();
            $table->string('primer_apellido', 22)->nullable();

            $table->date('fecha_nacimiento')->nullable();
            $table->smallInteger('estatus_persona')->default('1');
            $table->string('segundo_apellido', 22)->nullable();
            $table->string('telefono', 15)->nullable();
            $table->text('direccion_persona')->nullable();
            $table->float('sueldo_basico')->default(0.00);

            $table->integer('sitio_trabajo_id')->unsigned();
            $table->integer('tipo_sangre_id')->unsigned();
            $table->integer('cargo_id')->unsigned();
            $table->integer('ciudad_id')->unsigned();
            $table->integer('mina_id')->unsigned()->default(1);

            $table->index('identificacion', 'idnt');
            $table->enum('estado_persona', ['ACTIVA', 'INACTIVA', 'DESPEDIDA', 'JUBILADA', 'DISCAPACITADA'])->default('ACTIVA');
            
            $table->enum('sexo', ['HOMBRE', 'MUJER'])->nullable();

            $table->index(['identificacion', 'estado_persona']);

            $table->foreign('sitio_trabajo_id')->references('id')
                    ->on('sitios_trabajo')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('tipo_sangre_id')->references('id')
                    ->on('tipos_sangre')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('cargo_id')->references('id')
                    ->on('cargos')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('ciudad_id')->references('id')
                    ->on('ciudades')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('mina_id')->references('id')
                    ->on('minas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
