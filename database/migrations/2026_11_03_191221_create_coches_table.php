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
        Schema::create('coches', function (Blueprint $table) {
            $table->id();
            $table->string('matricula',20)->unique();
            $table->string('grupo',20);
            $table->string('marca',50);
            $table->string('modelo',50);

            $table->integer('numero_puertas');
            $table->integer('numero_plazas');
            $table->integer('capacidad_maletero');

            $table->integer('edad_minima');
            $table->string('codigo_oficina',10);
            $table->string('estado',20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coches');
    }
};
