<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "categories";

    protected $guarded = ['id', 'created_at', 'updated_at'];

    // 🧭 Parent category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // 📂 Children categories
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Relation with products
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Local scope for filter by name || status
     */
    public function scopeFilter($query, $filters)
    {
        if ($filters['name'] ?? false) {
            $query->where('name', 'LIKE', "%{$filters['name']}%");
        }

        if ($filters['status'] ?? false) {
            $query->whereStatus($filters['status']);
        }
    }

    /**
     * Local scope for list only trashed categories
     */
    public function scopeTrashed($query)
    {
        $query->onlyTrashed();
    }

    /**
     * Local scope for list only active categroires
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
}
