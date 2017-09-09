<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtapaProduccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etapas_produccion', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre_etapa');
            $table->string('codigo_etapa', 5)->nullable();
            $table->smallInteger('edo_reg')->default(1);

            $table->index(['codigo_etapa']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etapas_produccion');
    }
}
