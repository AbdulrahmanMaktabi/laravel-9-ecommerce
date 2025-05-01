<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'media';

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * Relation with media (images)
     */
    public function product()
    {
        return $this->belongsToMany(
            Product::class,
            'product_image',
            'image_id',
            'id',
            'product_id',
            'id'
        );
    }
}
