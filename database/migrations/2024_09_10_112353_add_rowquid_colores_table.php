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
        Schema::table('colores', function (Blueprint $table) {
            $table->text('rowquid')->nullable()->after('nombre');
        });

        $colores = \App\Models\Color::all();
        foreach ($colores as $color) {
            $row = \App\Models\Color::find($color->id);
            $row->rowquid = generarStringAleatorio(16);
            $row->save();
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('colores', function (Blueprint $table) {
            //
        });
    }
};
