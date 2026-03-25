<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proveedor', function (Blueprint $table) {
            $table->id('ID_Proveedor');
            $table->string('Nombre_Empresa');
            $table->string('Contacto');
            $table->string('Telefono');
            $table->string('Correo');
            $table->string('Direccion');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proveedor');
    }
};
