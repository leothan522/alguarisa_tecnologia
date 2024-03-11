<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tipo extends Model
{
    use HasFactory;
    protected $table = "tipos";
    protected $fillable = ['nombre'];

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('nombre', 'LIKE', "%$keyword%");
    }

    public function modelos(): HasMany
    {
        return $this->hasMany(Modelo::class, 'tipos_id', 'id');
    }

}
