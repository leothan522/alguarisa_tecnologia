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
        Schema::create('bienes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tipos_id')->unsigned();
            $table->bigInteger('marcas_id')->unsigned();
            $table->bigInteger('modelos_id')->unsigned();
            $table->bigInteger('colores_id')->unsigned();
            $table->string('serial')->nullable();
            $table->string('identificador')->nullable();
            $table->bigInteger('condiciones_id')->unsigned();
            $table->text('adicional')->nullable();
            $table->text('auditoria')->nullable();
            $table->foreign('tipos_id')->references('id')->on('tipos')->cascadeOnDelete();
            $table->foreign('marcas_id')->references('id')->on('marcas')->cascadeOnDelete();
            $table->foreign('modelos_id')->references('id')->on('modelos')->cascadeOnDelete();
            $table->foreign('colores_id')->references('id')->on('colores')->cascadeOnDelete();
            $table->foreign('condiciones_id')->references('id')->on('condiciones')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bienes');
    }
};
