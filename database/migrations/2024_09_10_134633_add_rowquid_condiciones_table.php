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
        Schema::table('condiciones', function (Blueprint $table) {
            $table->text('rowquid')->nullable()->after('nombre');
        });

        $condiciones = \App\Models\Condicion::all();
        foreach ($condiciones as $condicion) {
            $row = \App\Models\Condicion::find($condicion->id);
            $row->rowquid = generarStringAleatorio(16);
            $row->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('condiciones', function (Blueprint $table) {
            //
        });
    }
};
