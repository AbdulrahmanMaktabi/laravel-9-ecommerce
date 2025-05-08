<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'cookie_id',
        'qty',
        'product_id'
    ];

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
        static::creating(function (Cart $cart) {
            $cart->id = Str::uuid();
            $cart->cookie_id = self::getCookieId();
        });

        static::addGlobalScope('cookieId', function ($query) {
            $query->where('cookie_Id', Cart::getCookieId());
        });
    }

    protected static function getCookieId()
    {
        $cookieId = Cookie::get('cookie_id');

        if (!$cookieId) {
            // Queue the cookie for 30 days
            $cookieId = Str::uuid();

            Cookie::queue('cookie_id', $cookieId, 60 * 24 * 30);
        }

        return $cookieId;
    }
}
