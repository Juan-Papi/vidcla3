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
        Schema::create('nota_compras', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->date('fecha');
            $table->decimal('precio_unitario', 8, 2);
            $table->decimal('importe_total', 8, 2);

            $table->unsignedBigInteger('almacen_id');
            $table->unsignedBigInteger('parabrisa_id');
            $table->unsignedBigInteger('proveedor_id');

            $table->foreign('almacen_id')->references('id')->on('almacens')->onDelete('cascade');
            $table->foreign('parabrisa_id')->references('id')->on('parabrisas')->onDelete('cascade');
            $table->foreign('proveedor_id')->references('id')->on('proveedors')->onDelete('cascade');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota_compras');
    }
};
