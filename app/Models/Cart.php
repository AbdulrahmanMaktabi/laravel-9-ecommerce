<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $guraded = ['creatd_at', 'updated_at', 'id'];

    public $incrementing = false;

    /**
     * Realtion with product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relation with user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Observers
     */
    public static function booted()
    {
        static::creating(function (Product $product) {
            $product->id = Str::uuid();
        });
    }
}
