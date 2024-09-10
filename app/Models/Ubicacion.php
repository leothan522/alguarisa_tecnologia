<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ubicacion extends Model
{
    use HasFactory;
    protected $table = "ubicaciones";
    protected $fillable = ['nombre', 'rowquid'];

    public function bienes(): HasMany
    {
        return $this->hasMany(BienUbicacion::class, 'ubicaciones_id', 'id');
    }

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('nombre', 'LIKE', "%$keyword%");
    }
}
