<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransporteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transporte', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            /**
             * LLAVES FORANEAS
             */
            $table->integer('persona_id')->unsigned();
            $table->integer('vehiculo_id')->unsigned();
            $table->integer('tipo_material_id')->unsigned();
            $table->integer('mina_id')->default(1)->unsigned();

            /**
             * DATOS DE TIPO DATE REFERENTES AL VIAJE
             */
            $table->date('fecha_salida')->nullable();
            $table->date('fecha_llegada')->nullable();

            /**
             * MONTOS A CALCULAR
             */
            $table->float('precio_combustible')->default(0);
            $table->float('kilo_viajes')->default(0);
            $table->float('precio_kilo')->default(0);
            $table->float('combustible_viaje')->default();
            $table->float('precio_x_lts_combustible')->float(0);
            $table->float('total_kilo_material')->default(0);
            $table->float('total_kilo_viaje_material')->default(0);
            $table->float('total_factura')->default(0);

            $table->string('procedencia', 160)->nullable();
            $table->string('destino', 160)->nullable();
            $table->string('recibo', 20)->default('--');
            $table->string('nro_factura', 7)->default('0000000');
            $table->string('concepto_viaje', 220)->default('--');

            /**
             * DATOS DEL CLIENTE
             */
            $table->string('razon_social_cliente', 220)->default('--');
            $table->string('ident_cliente', 33)->default('--');
            $table->string('telefono_cliente', 22)->default('--');
            $table->string('email_cliente', 23)->default('--');

            $table->enum('estado_registro', ['ACTIVA', 'ANULADA', 'COMPLETADA'])->default('ACTIVA');

            $table->index(['nro_factura']);

            $table->foreign('persona_id')->references('id')
                    ->on('personas')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('vehiculo_id')->references('id')
                    ->on('vehiculos')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('tipo_material_id')->references('id')
                    ->on('tipos_material')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('transporte');
    }
}
