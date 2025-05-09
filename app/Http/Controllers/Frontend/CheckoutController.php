<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function create(CartRepository $cart)
    {
        return view('frontend.checkout');
    }

    public function store(Request $request, CartRepository $cart)
    {
        $order = Order::create([
            'store_id'          => '1',
            'user_id'           => $request->user()?->id,
            'payment_method'    => 'card'
        ]);

        foreach ($cart->get() as $item) {
            OrderItem::create([
                'order_id'      => $order->id,
                'product_id'    => $item->product?->id,
                'product_name'    => $item->product?->title,
                'product_price'    => $item->product?->price,
                'product_price'    => $item->qty,
            ]);
        }

        foreach ($request->post("address") as $type => $address) {
            $address['type'] = $type;
            $order->addresses()->create($address);
        }
        return true;
    }
}
