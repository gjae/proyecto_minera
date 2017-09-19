<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->enum('tipo_orden', ['COMPRA', 'SERVICIOS'])->default('COMPRA');
            $table->enum('estado_orden', ['EMITIDA', 'APROBADA', 'ANULADA', 'ELIMINADA'])->default('EMITIDA');
            $table->string('codigo_analisis', 8);
            $table->string('concepto')->nullable();
            $table->string('codigo_orden', 10);
            $table->string('proyecto', 140)->default('SOCIEDAD MINERA DEL NORTE');

            $table->float('total_iva')->default(0);
            $table->float('total_sin_descuento')->default(0);
            $table->float('descuento')->default(0);
            $table->float('subtotal')->default(0);
            $table->float('retefuente')->default(0);
            $table->float('total')->default(0);
            $table->float('anticipo')->default(0);
            $table->float('monto_anticipo')->default(0);

            $table->char('mes_anticipo', 1)->default('N');
            $table->integer('tiempo_pago')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->string('contte_nombre');
            $table->string('contte_nit_cc', 15);
            $table->string('contte_telefono')->nullable();
            $table->string('contte_rep_legal')->nullable();
            $table->string('contte_cc', 23)->nullable();
            $table->string('contte_resp', 170)->nullable();
            $table->string('contte_resp_cc', 190)->nullable();
            $table->string('contte_resp_email', 130)->nullable();
            $table->string('contte_resp_cargo', 160)->nullable();
            $table->string('contte_rep_telf', 90)->nullable();

            $table->string('contta_nit_cc', 15);
            $table->string('contta_dir', 15);
            $table->string('contta_resp', 170)->nullable();
            $table->string('contta_resp_legal', 170)->nullable();
            $table->string('contta_resp_cc', 190)->nullable();
            $table->string('contta_resp_email', 130)->nullable();
            $table->string('contta_resp_cargo', 160)->nullable();
            $table->string('contta_rep_telf', 90)->nullable();

            $table->integer('proveedor_id')->unsigned();
            

            //$table->index(['codigo_orden']);

            $table->foreign('proveedor_id')->references('id')
                    ->on('proveedores')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenes');
    }
}
