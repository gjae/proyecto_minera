<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre_mina', 160)->default('--');
            $table->string('codigo_mina', 7)->default('--');

            $table->smallInteger('edo_reg')->default(1);

            //$table->index(['codigo_mina']);
        });
        \DB::table('minas')->insert([
                'nombre_mina' => 'DEFECTO',
                'codigo_mina' => '000000',
                'edo_reg' => 0
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('minas');
    }
}
