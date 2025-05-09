<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at', 'id'];

    /**
     * Relation with Store Model
     * One To Many
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }


    /**
     * Relation with User Model
     * One To Many
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Defines a many-to-many relationship between the current model (e.g., Order) and OrderItem,
     * using the 'order_items' pivot table. The foreign key on the current model is 'order_id',
     * and the related key on the OrderItem model is 'product_id'. The pivot table also includes
     * additional columns: 'product_name', 'price', 'qty', and 'option'.
     */
    public function products()
    {
        return $this->belongsToMany(OrderItem::class, 'order_items', 'order_id', 'product_id', 'id', 'id')
            ->withPivot(['product_name', 'price', 'qty', 'option']);
    }

    /**
     * Defines a one-to-many relationship to get all addresses associated with the order.
     * This typically includes both billing and shipping addresses.
     */
    public function addresses()
    {
        return $this->hasMany(OrderAddress::class);
    }

    /**
     * Defines a one-to-one relationship to retrieve the billing address
     * for the order from the order_addresses table where type is 'billing'.
     */
    public function billingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')
            ->where('type', 'billing');
    }

    /**
     * Defines a one-to-one relationship to retrieve the shipping address
     * for the order from the order_addresses table where type is 'shipping'.
     */
    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')
            ->where('type', 'shipping');
    }

    public static function booted()
    {

        /**
         * Observer to generate order number when creating new object of Order model
         */
        static::creating(function (Order $order) {
            $order->number = Order::getOrderNumber();
        });
    }

    /**
     * Private function go generate an order number based on year
     */
    private static function getOrderNumber()
    {
        $year = Carbon::now()->year;

        // wherYear focus on year only 
        $number = Order::whereYear('created_at', $year)
            ->max('number');

        if (!$number)
            return $year . "0001";

        return $number + 1;
    }
}
