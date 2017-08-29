<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('password');
            $table->string('remember_token', 255)->nullable();
            $table->enum('tipo_usuario', ['INVITADO','ADMIN', 'NOMINA', 'REQUISICIONES', 'TRANSPORTE', 'INVENTARIO', 'PROCURA'])
                    ->default('INVITADO');
                    
            $table->tinyInteger('edo_reg')->default(1);
            $table->integer('persona_id')->nullable()->unsigned();
            
            $table->timestamps();
        });

        \DB::table('users')->insert([
                'email' => 'admin',
                'password' => bcrypt('admin'),
                'tipo_usuario' =>'ADMIN'
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
