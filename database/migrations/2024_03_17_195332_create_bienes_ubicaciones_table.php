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
        Schema::create('bienes_ubicaciones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bienes_id')->unsigned();
            $table->bigInteger('ubicaciones_id')->unsigned();
            $table->integer('actual')->default(0);
            $table->foreign('bienes_id')->references('id')->on('bienes')->cascadeOnDelete();
            $table->foreign('ubicaciones_id')->references('id')->on('ubicaciones')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bienes_ubicaciones');
    }
};
