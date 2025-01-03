<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    use HasFactory;
    protected $table = "parametros";
    protected $fillable = ['nombre', 'tabla_id', 'valor', 'rowquid'];

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('nombre', 'LIKE', "%$keyword%")
            ->orWhere('tabla_id', 'LIKE', "%$keyword%")
            ->orWhere('valor', 'LIKE', "%$keyword%");
    }
}
