<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Scopes\Dashboard\storeProductsScope;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'image'];

    protected $appends = ['imageUrl'];

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
        $options = array_merge([
            'store_id' => null,
            'category_id' => null,
            'title' => null,
            'status' => null,
            'tag_id' => null
        ], $filters);

        $query->when($options['store_id'], function ($query) use ($options) {
            $query->where('store_id', $options['store_id']);
        });

        $query->when($options['category_id'], function ($query) use ($options) {
            $query->where('category_id', $options['category_id']);
        });

        $query->when($options['title'], function ($query) use ($options) {
            $query->where('title', 'LIKE', "%{$options['title']}%");
        });

        $query->when($options['status'], function ($query) use ($options) {
            $query->where('status', $options['status']);
        });

        $query->when($options['tag_id'], function ($query) use ($options) {
            // $query->whereHas('tags', function ($query) use ($options) {
            //     $query->where('tag_id', $options['tag_id']);
            // });

            // $query->whereRaw(
            //     'Exists (SELECT 1 FROM product_tag where product_id = products.id AND tag_id = ?',
            //     [$options['tag_id']]
            // );

            $query->whereExists(function ($query) use ($options) {
                $query->select(DB::raw(1))
                    ->from('product_tag')
                    ->whereRaw('product_tag.product_id = products.id')
                    ->where('tag_id', $options['tag_id']);
            });
        });

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
        // static::addGlobalScope(new storeProductsScope());
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
