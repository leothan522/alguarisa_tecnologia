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
        Schema::create('modelos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->bigInteger('tipos_id')->unsigned();
            $table->bigInteger('marcas_id')->unsigned();
            $table->foreign('tipos_id')->references('id')->on('tipos')->cascadeOnDelete();
            $table->foreign('marcas_id')->references('id')->on('marcas')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modelos');
    }
};
