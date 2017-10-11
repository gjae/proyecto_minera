<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeguroPersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguro_persona', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('seguro_id')->unsigned();
            $table->integer('persona_id')->unsigned();
            $table->float('porcentaje_deduccion')->default(0.00);
            $table->float('monto_deduccion')->default(0.00);
            $table->enum('aporte', ['PERSONA', 'PATRON'])->default('PERSONA');
            $table->enum('tipo_aporte', ['SEGURO', 'PENSION'])->default('SEGURO');

            $table->foreign('persona_id')->references('id')
                    ->on('personas')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('seguro_id')->references('id')->on('seguros')
                    ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seguro_persona');
    }
}
