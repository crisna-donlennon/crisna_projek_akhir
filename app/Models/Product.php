<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_product', 'id_product', 'id_cart')->withPivot('kuantitas');
    }
}
