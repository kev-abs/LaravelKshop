<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cupon_cliente', function (Blueprint $table) {
            $table->id(); // ID principal
            $table->foreignId('ID_Cupon')->constrained('cupon')->onDelete('cascade'); // referencia a cupon
            $table->foreignId('ID_Cliente')->constrained('clientes')->onDelete('cascade'); // referencia a cliente
            $table->boolean('Usado')->default(0); // si el cupón fue usado
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cupon_cliente');
    }
};