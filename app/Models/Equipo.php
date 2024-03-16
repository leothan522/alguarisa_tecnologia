<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Equipo extends Model
{
    use HasFactory;
    protected $table = "equipos";
    protected $fillable = ['oficios_id', 'bienes_id'];

    public function oficio(): BelongsTo
    {
        return $this->belongsTo(Oficio::class, 'oficios_id', 'id');
    }

}
