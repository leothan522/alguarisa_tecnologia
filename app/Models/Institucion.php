<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Institucion extends Model
{
    use HasFactory;
    protected $table = 'oficios_instituciones';
    protected $fillable = [
        'nombre',
        'sufijo',
        'rowquid'
    ];

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('nombre', 'LIKE', "%$keyword%");
    }

    public function personas(): HasMany
    {
        return $this->hasMany(Persona::class, 'institucion_id', 'id');
    }

}
