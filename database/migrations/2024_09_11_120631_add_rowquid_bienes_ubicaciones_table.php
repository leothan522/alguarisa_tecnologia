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
        Schema::table('bienes_ubicaciones', function (Blueprint $table) {
            $table->text('rowquid')->nullable()->after('actual');
        });

        $ubicaciones = \App\Models\BienUbicacion::all();
        foreach ($ubicaciones as $ubicacion) {
            $row = \App\Models\BienUbicacion::find($ubicacion->id);
            $row->rowquid = generarStringAleatorio(16);
            $row->save();
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bienes_ubicaciones', function (Blueprint $table) {
            //
        });
    }
};
