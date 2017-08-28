<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisicionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisiciones', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('codigo_requisicion', 12);
            $table->string('concepto_requisicion')->nullable();

            $table->integer('user_id')->unsigned();
            $table->enum('tipo_requisicion', ['BIENES', 'SERVICIOS'])->default('BIENES');

            $table->enum('estado_requisicion', ['APROBADA', 'EMITIDA', 'REVERSADA', 'ANULADA', 'PROCESADA'])->default('EMITIDA');
            
            $table->float('total_requisicion')->default(0.00);
            $table->float('total_impuestos')->default(0.00);
            $table->float('sub_total')->default(0.00);
            $table->date('fecha_requerida')->nullable();


            $table->index(['codigo_requisicion', 'tipo_requisicion']);

            $table->foreign('user_id')->references('id')
                    ->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requisiciones');
    }
}
