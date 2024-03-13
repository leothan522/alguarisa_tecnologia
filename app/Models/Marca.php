<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Marca extends Model
{
    use HasFactory;
    protected $table = "marcas";
    protected $fillable = ['nombre'];

    public function modelos(): HasMany
    {
        return $this->hasMany(Modelo::class, 'marcas_id', 'id');
    }

    public function bienes(): HasMany
    {
        return $this->hasMany(Bien::class, 'marcas_id', 'id');
    }

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('nombre', 'LIKE', "%$keyword%");
    }

}
