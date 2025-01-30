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
            $table->integer('verificado')->default(0)->after('auditoria');
            $table->bigInteger('users_id')->unsigned()->nullable()->after('verificado');
        });
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
