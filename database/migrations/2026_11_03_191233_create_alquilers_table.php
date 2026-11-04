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
        Schema::create('alquilers', function (Blueprint $table) {
            $table->id();
            $table->string('matricula',20);
            $table->integer('dni');

            $table->date('fecha_inicio');
            $table->date('fecha_devolucion_prevista');
            $table->date('fecha_devolucion_real')->nullable();

            $table->integer('duracion_dias');

            $table->string('tipo_seguro',30);

            $table->decimal('precio_total',10,2);
            $table->decimal('recargo',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alquilers');
    }
};
