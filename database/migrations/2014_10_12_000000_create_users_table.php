<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   //definimos la estructura y campos de la tabla users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        // Insertamos dos registros en la tabla users durante la migración
        DB::table('users')->insert([
            'name' => 'Byron Celi',
            'email' => 'byron@gmail.com',
            'password' => bcrypt('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Carlos Diaz',
            'email' => 'carlos@gmail.com',
            'password' => bcrypt('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Desactiva temporalmente las restricciones de clave externa
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Elimina la tabla
        Schema::dropIfExists('users');

        // Activa las restricciones de clave externa nuevamente
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
};
