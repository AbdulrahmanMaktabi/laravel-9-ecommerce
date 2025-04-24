<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';

    protected $guerded = ['id', 'created_at', 'updated_at'];

    /**
     * Realtion with stores table
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Realtion with categories table
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Filter
     */
    public function scopeFilter($query, $filters)
    {
        if ($filters['title'] ?? false) {
            $query->where('title', 'LIKE', "%{$filters['title']}%");
        }

        if ($filters['status'] ?? false) {
            $query->whereStatus($filters['status']);
        }
    }
}
