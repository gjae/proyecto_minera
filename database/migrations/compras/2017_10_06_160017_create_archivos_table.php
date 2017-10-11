<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre_original');
            $table->string('ruta', 130)->nullable();
            $table->string('tipo_archivo')->nullable();
            $table->string('nombre_archivo', 170);
            $table->float('tamano')->default(0);
            $table->integer('orden_id')->unsigned();
            $table->string('extension', 10);
            $table->string('comentario')->nullable();

            $table->foreign('orden_id')->references('id')
                    ->on('ordenes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archivos');
    }
}
