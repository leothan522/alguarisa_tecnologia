<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BienUbicacion extends Model
{
    use HasFactory;
    protected $table = "bienes_ubicaciones";
    protected $fillable = [
        'bienes_id',
        'ubicaciones_id',
        'actual',
        'rowquid'
    ];

    public function bien(): BelongsTo
    {
        return $this->belongsTo(Bien::class, 'bienes_id', 'id');
    }

    public function ubicacion(): BelongsTo
    {
        return  $this->belongsTo(Ubicacion::class, 'ubicaciones_id', 'id');
    }

}
