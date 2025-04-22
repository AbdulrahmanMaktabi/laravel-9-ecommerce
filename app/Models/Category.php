<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

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

    public function scopeFillter($query, $filters)
    {
        if ($filters['name'] ?? false) {
            $query->where('name', 'LIKE', "%{$filters['name']}%");
        }

        if ($filters['status'] ?? false) {
            $query->whereStatus($filters['status']);
        }
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
