<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   //definimos la estructura de la tabla post con la relacion con la tabla users
        Schema::create('posts', function (Blueprint $table) {
            $table->id('post_id');
            $table->foreignId('users_id')->constrained('users', 'id');
            $table -> string('titulo');
            $table -> text('contenido');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
