<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Parroquia extends Model
{
    use HasFactory;

    protected $table = "parroquias";
    protected $fillable = [
        'nombre',
        'mini',
        'familias',
        'municipios_id',
        'estatus',
        'rowquid'
    ];

    public function municipio(): BelongsTo
    {
        return $this->belongsTo(Municipio::class, 'municipios_id', 'id');
    }

    public function scopeBuscar($query, $keyword, $idMunicipio = null)
    {
        if (is_null($idMunicipio)) {
            return $query->where('nombre', 'LIKE', "%$keyword%")
                ->orWhere('mini', 'LIKE', "%$keyword%");
        } else {
            return $query->where('municipios_id', '=', $idMunicipio);
        }
    }

}
