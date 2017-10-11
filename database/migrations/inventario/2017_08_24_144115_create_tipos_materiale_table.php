<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiposMaterialeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_material', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('codigo_tipo', 8);
            $table->string('descripcion_tipo', 150);
            $table->smallInteger('edo_reg')->default(1);

            //$table->index(['codigo_tipo']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_material');
    }
}
