<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Oficio extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "oficios";
    protected $fillable = [
        'numero',
        'fecha',
        'equipos',
        'adicional',
        'pdf',
        'dirigido',
        'copia',
        'repetido',
        'auditoria',
        'rowquid'
    ];

    public function equipos(): HasMany
    {
        return $this->hasMany(Equipo::class, 'oficios_id', 'id');
    }

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('numero', 'LIKE', "%$keyword%")
            ->orWhere('fecha', 'LIKE', "%$keyword%");
    }

}
