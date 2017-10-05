<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiciplinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diciplinas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre_diciplina');
            $table->string('codigo_diciplina', 8)->nullable();
            $table->smallInteger('edo_reg')->default(1);

           // $table->index(['codigo_diciplina']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diciplinas');
    }
}
