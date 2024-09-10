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
        Schema::table('bienes', function (Blueprint $table) {
            $table->dropColumn('token');
            $table->text('rowquid')->nullable()->after('auditoria');
        });

        $bienes = \App\Models\Bien::all();
        foreach ($bienes as $bien) {
            $row = \App\Models\Bien::find($bien->id);
            $row->rowquid = generarStringAleatorio(16);
            $row->save();
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bienes', function (Blueprint $table) {
            //
        });
    }
};
