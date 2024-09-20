<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Persona extends Model
{
    use HasFactory;
    protected $table = 'oficios_personas';
    protected $fillable = [
        'nombre',
        'prefijo',
        'cargo',
        'instituciones_id',
        'sexo'
    ];

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('nombre', 'LIKE', "%$keyword%")
            ->orWhere('prefijo', 'LIKE', "%$keyword%")
            ->orWhere('cargo', 'LIKE', "%$keyword%")
            ->orWhere('instituciones_id', is_numeric($keyword) ? $keyword : null);
    }

    public function institucion(): BelongsTo
    {
        return $this->belongsTo(Institucion::class, 'instituciones_id', 'id');
    }

}
