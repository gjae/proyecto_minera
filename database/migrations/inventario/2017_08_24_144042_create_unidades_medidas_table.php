<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadesMedidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades_medida', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('codigo_unidad', 10);
            $table->string('descripcion_unidad', 150);

            $table->smallInteger('edo_reg')->default(1);

          //  $table->index(['codigo_unidad']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unidades_medida');
    }
}
