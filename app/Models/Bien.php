<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bien extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "bienes";
    protected $fillable = [
        'tipos_id',
        'marcas_id',
        'modelos_id',
        'colores_id',
        'serial',
        'identificador',
        'condiciones_id',
        'adicional',
        'auditoria',
    ];

    public function tipo(): BelongsTo
    {
        return $this->belongsTo(Tipo::class, 'tipos_id', 'id');
    }

    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class, 'marcas_id', 'id');
    }

    public function modelo(): BelongsTo
    {
        return $this->belongsTo(Modelo::class, 'modelos_id', 'id');
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'colores_id', 'id');
    }

    public function condicion(): BelongsTo
    {
        return $this->belongsTo(Condicion::class, 'condiciones_id', 'id');
    }

    public function imagenes(): HasMany
    {
        return $this->hasMany(Imagen::class, 'bienes_id', 'id');
    }

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('serial', 'LIKE', "%$keyword%")
            ->orWhere('identificador', 'LIKE', "%$keyword%");
    }

}
