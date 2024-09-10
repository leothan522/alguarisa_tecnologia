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
        Schema::table('ubicaciones', function (Blueprint $table) {
            $table->text('rowquid')->nullable()->after('nombre');
        });

        $ubicaciones = \App\Models\Ubicacion::all();
        foreach ($ubicaciones as $ubicacion) {
            $row = \App\Models\Ubicacion::find($ubicacion->id);
            $row->rowquid = generarStringAleatorio(16);
            $row->save();
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ubicaciones', function (Blueprint $table) {
            //
        });
    }
};
