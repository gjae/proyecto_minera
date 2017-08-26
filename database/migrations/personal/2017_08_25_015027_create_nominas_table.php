<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNominasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nominas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->char('codigo_nomina', 4);
            $table->date('periodo_nomina');
            $table->enum('estado_nomina', ['ABIERTA', 'CERRADA', 'ANULADA'])
                    ->default('ABIERTA');
            $table->float('total_nomina')->default(0.00);
            $table->float('total_deducciones')->default(0.00);

            $table->index(['estado_nomina']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nominas');
    }
}
