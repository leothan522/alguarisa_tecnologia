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
            $table->text('dirigido')->nullable()->after('pdf');
            $table->text('copia')->nullable()->after('dirigido');
            $table->integer('repetido')->default(0)->after('copia');
        });

        $oficios = \App\Models\Oficio::all();
        foreach ($oficios as $oficio){
            $exite = false;
            $repetidos = \App\Models\Oficio::where('numero', $oficio->numero)
                ->where('id', '!=', $oficio->id)->get();
            foreach ($repetidos as $repetido){
                $editar = \App\Models\Oficio::find($repetido->id);
                $editar->repetido = 1;
                $editar->save();
                $exite = true;
            }
            if ($exite){
                $editar = \App\Models\Oficio::find($oficio->id);
                $editar->repetido = 1;
                $editar->save();
            }
        }
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
