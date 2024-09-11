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
        Schema::table('imagenes', function (Blueprint $table) {
            $table->text('rowquid')->nullable()->after('banner');
        });

        $imagenes = \App\Models\Imagen::all();
        foreach ($imagenes as $imagen) {
            $row = \App\Models\Imagen::find($imagen->id);
            $row->rowquid = generarStringAleatorio(16);
            $row->save();
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('imagenes', function (Blueprint $table) {
            //
        });
    }
};
