<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateLoanDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('detalles_prestamo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_prestamo')->constrained('prestamos')->onDelete('cascade');
            $table->foreignId('id_libro')->constrained('libros');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalles_prestamo');
    }
}