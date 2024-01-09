<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_product',
        'deskripsi',
        'stok',
        'harga',
        'gambar',
        'type_id'
    ];
    
    public function type() : BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
