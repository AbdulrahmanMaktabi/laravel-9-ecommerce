<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "tags";

    protected $guarded = ['created_at', 'updated_at', 'id', 'deleted_at'];

    /**
     * Realtion with products
     */
    public function products()
    {
        return $this->belongsToMany(
            Product::class, // Related Model
            'product_id',
            'product_tag',
            'product_id',
            'id',
            'id'
        );
    }

    /**
     * Route key name
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
