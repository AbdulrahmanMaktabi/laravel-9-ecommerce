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

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function products()
    {
        return $this->belongsToMany(OrderItem::class, 'order_items')
            ->withPivot(['product_name', 'price', 'qty', 'options']);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function booted()
    {
        static::creating(function (Order $order) {
            $order->number = Order::getOrderNumber();
        });
    }

    public static function getOrderNumber()
    {
        $year = Carbon::now()->year;

        $number = Order::whereYear('created_at', $year)
            ->max('number');

        if (!$number)
            return $year . "0001";

        return $number + 1;
    }
}
