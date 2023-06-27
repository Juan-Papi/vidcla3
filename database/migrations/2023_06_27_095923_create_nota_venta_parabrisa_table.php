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
        Schema::create('nota_venta_parabrisa', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->decimal('precio_venta', 8, 2);
            $table->decimal('importe', 8, 2);
            
            $table->unsignedBigInteger('nota_venta_id');
            $table->unsignedBigInteger('parabrisa_id');
            $table->timestamps();

            $table->foreign('nota_venta_id')->references('id')->on('nota_ventas')->onDelete('cascade');
            $table->foreign('parabrisa_id')->references('id')->on('parabrisas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota_venta_parabrisa');
    }
};
