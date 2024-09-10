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
        Schema::table('tipos', function (Blueprint $table) {
            $table->text('rowquid')->nullable()->after('nombre');
        });

        $tipos = \App\Models\Tipo::all();
        foreach ($tipos as $tipo) {
            $row = \App\Models\Tipo::find($tipo->id);
            $row->rowquid = generarStringAleatorio(16);
            $row->save();
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tipos', function (Blueprint $table) {
            //
        });
    }
};
