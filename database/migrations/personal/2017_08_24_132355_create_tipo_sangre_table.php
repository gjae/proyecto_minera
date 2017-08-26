<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoSangreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_sangre', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('descripcion_tipo', 120);
            $table->string('abreviatura_tipo', 10);

            $table->tinyInteger('edo_tipo');
            $table->index(['abreviatura_tipo']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_sangre');
    }
}
