<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Imagen extends Model
{
    use HasFactory;
    protected $table = 'imagenes';
    protected $fillable = [
        'bienes_id',
        'imagen',
        'mini',
        'detail',
        'cart',
        'banner'
    ];

    public function bien(): BelongsTo
    {
        return $this->belongsTo(Bien::class, 'bienes_id', 'id');
    }

}
