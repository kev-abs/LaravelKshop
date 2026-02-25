<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cupon', function (Blueprint $table) {
            $table->id('id_cupon');
            $table->string('codigo');
            $table->integer('descuento');
            $table->date('fecha_expiracion');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cupon');
    }
};