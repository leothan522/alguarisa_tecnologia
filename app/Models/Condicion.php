<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Condicion extends Model
{
    use HasFactory;
    protected $table = "condiciones";
    protected $fillable = ['nombre'];

    public function bienes(): HasMany
    {
        return $this->hasMany(Bien::class, 'condiciones_id', 'id');
    }

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('nombre', 'LIKE', "%$keyword%");
    }

}
