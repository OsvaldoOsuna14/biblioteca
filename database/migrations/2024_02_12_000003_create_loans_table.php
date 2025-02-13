<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateLoansTable extends Migration
{
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cliente')->constrained('usuarios');
            $table->foreignId('creado_por')->constrained('usuarios');
            $table->foreignId('cerrado_por')->nullable()->constrained('usuarios');
            $table->timestamp('fecha_prestamo');
            $table->timestamp('fecha_limite');
            $table->timestamp('fecha_devolucion')->nullable();
            $table->enum('estado', ['Activo', 'Cerrado'])->default('Activo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prestamos');
    }
}