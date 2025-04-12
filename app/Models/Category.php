<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $guareded = ['id', 'created_at', 'updated_at'];

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
}
