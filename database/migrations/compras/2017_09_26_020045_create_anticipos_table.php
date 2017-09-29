<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnticiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anticipos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('concepto_anticipo', 150)->nullable();
            $table->char('consecutivo', 4)->nullable();
            $table->float('porcentaje')->default(0);
            $table->float('total_anticipo')->default(0);
            $table->integer('orden_id')->unsigned();

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
        Schema::dropIfExists('anticipos');
    }
}
