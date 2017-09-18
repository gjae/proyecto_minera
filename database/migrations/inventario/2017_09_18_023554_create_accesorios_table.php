<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccesoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesorios', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('nombre_accesorio');
            $table->enum('tipo_accesorio', [
                    'decoracion',
                    'funcional',
                    'mecanico',
                    'electrico',
                    'otros'
                ])->default('funcional');

            $table->enum('material_accesorio', [
                    'madera',
                    'metal',
                    'plastico',
                    'tierra',
                    'piedra',
                    'otros'
                ]);

            $table->string('modelo', 60)->nullable();
            $table->string('serie', 120)->nullable();
            $table->string('marca', 70)->nullable();
            $table->date('fecha_compra')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accesorios');
    }
}
