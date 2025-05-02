<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Scopes\Dashboard\storeProductsScope;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Relation with stores table
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Relation with categories table
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relation with media 
     */
    public function media()
    {
        return $this->belongsToMany(
            Media::class,
            'product_image',
            'product_id',
            'image_id',
            'id',
            'id'
        );
    }

    /**
     * Relation with tags
     */
    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'product_tag',
            'product_id',
            'tag_id',
            'id',
            'id'
        );
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
     * Only active scope
     */
    public function scopeActive($query)
    {
        $query->where('status', 'active');
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted()
    {
        static::addGlobalScope(new storeProductsScope());
    }

    /**
     * Image accessor
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image)
            return "https://tinasbotanicals.com/wp-content/uploads/2025/01/No-Product-Image-Available.png";
        if (Str::startsWith($this->image, ['https://', 'http://']))
            return $this->image;

        return asset($this->image);
    }

    /**
     * Discount accessor
     */
    public function getDiscountAttribute()
    {
        if ($this->compare_price)
            return round(100 - (100 * ($this->price / $this->compare_price)));
        return 0;
    }

    /**
     * Route key name
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
