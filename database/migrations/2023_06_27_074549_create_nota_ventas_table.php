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
        Schema::create('nota_ventas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->decimal('monto_total', 8, 2);

            $table->unsignedBigInteger('pago_id')->nullable()->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('factura_id')->nullable()->unique();
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('almacen_id');

            $table->foreign('pago_id')->references('id')->on('plan_pagos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('factura_id')->references('id')->on('facturas')->onDelete('cascade');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('almacen_id')->references('id')->on('almacens')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota_ventas');
    }
};
