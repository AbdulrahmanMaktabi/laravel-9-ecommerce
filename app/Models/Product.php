<?php

namespace App\Models;

use App\Models\Scopes\Dashboard\StoreProducts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';

    protected $guarded = ['id', 'created_at', 'updated_at'];

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

        return $query;
    }

    /**
     * Only trashed scope
     */
    public function scopeTrashed($query)
    {
        $query->onlyTrashed();
    }

    /**
     * Local scope for list only active products
     */
    public function scopeActive($query)
    {
        $query->where('status', 'active');
    }

    /**
     * Route key name
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new StoreProducts);
    }
}
