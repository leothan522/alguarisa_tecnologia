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
        Schema::create('oficios_personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('prefijo')->nullable();
            $table->string('cargo')->nullable();
            $table->bigInteger('instituciones_id')->unsigned()->nullable();
            $table->string('sexo');
            $table->text('rowquid');
            $table->foreign('instituciones_id')->references('id')->on('oficios_instituciones')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oficios_personas');
    }
};
