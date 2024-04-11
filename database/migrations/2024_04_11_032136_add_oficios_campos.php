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
        Schema::table('oficios', function (Blueprint $table) {
            $table->text('adicional')->after('equipos')->nullable();
            $table->text('pdf')->after('adicional')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('oficios', function (Blueprint $table) {
            //
        });
    }
};
