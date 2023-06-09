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
        Schema::create('almacen_parabrisa', function (Blueprint $table) {
            $table->id();
            $table->integer('stock');

            $table->unsignedBigInteger('almacen_id');
            $table->unsignedBigInteger('parabrisa_id');

            $table->foreign('almacen_id')->references('id')->on('almacens')->onDelete('cascade');
            $table->foreign('parabrisa_id')->references('id')->on('parabrisas')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('almacen_parabrisa');
    }
};
