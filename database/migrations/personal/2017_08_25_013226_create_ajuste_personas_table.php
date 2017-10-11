<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateajustePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ajuste_personas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('persona_id')->unsigned();
            $table->integer('ajuste_id')->unsigned();

            $table->foreign('persona_id')->references('id')
                    ->on('personas')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('ajuste_id')->references('id')
                    ->on('ajustes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ajuste_personas');
    }
}
