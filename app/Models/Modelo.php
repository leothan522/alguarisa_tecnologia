<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Modelo extends Model
{
    use HasFactory;
    protected $table = "modelos";
    protected $fillable = ['nombre', 'tipos_id', 'marcas_id'];

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('nombre', 'LIKE', "%$keyword%");
    }

    public function tipo(): BelongsTo
    {
        return $this->belongsTo(Tipo::class, 'tipos_id', 'id');
    }

    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class, 'marcas_id', 'id');
    }

}
