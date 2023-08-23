<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hospitales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('direccion');
            $table->string('telefono');
            $table->string('correo')->unique();
            $table->string('image_path');
            $table->string('contacto_nombre');
            $table->string('contacto_telefono');
            $table->string('contacto_correo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospital');
    }
};
