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
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('autor');
            // ** 8 digitos como maximo y 2 decimales
            $table->decimal('precio',8,2)->default(0.00);
            //stock sera un numero entero que no permitira numeros negativos
            $table->unsignedBigInteger('stock')->default(0);
            // nullable() permite que el producto se guarde como "borrador" sin fecha aún.
            $table->dateTime('fecha_publicacion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};
