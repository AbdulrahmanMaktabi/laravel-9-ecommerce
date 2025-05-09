<?php

namespace App\Http\Controllers\Frontend;

use App\Facades\Loggy;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CheckoutStoreRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class CheckoutController extends Controller
{
    public function create(CartRepository $cart)
    {
        return view('frontend.checkout', get_defined_vars());
    }

    public function store(CheckoutStoreRequest $request, CartRepository $cart)
    {
        $request->validated();

        DB::beginTransaction();

        try {
            $cartItems = $cart->get()->groupBy('product.store_id')->all();
            foreach ($cartItems as $store => $item) {
                // Create the order
                $order = Order::create([
                    'store_id'       => $store,
                    'user_id'        => $request->user()?->id,
                    'payment_method' => 'card',
                ]);

                // Loop through cart items and save each as an order item
                foreach ($cart->get() as $item) {
                    OrderItem::create([
                        'order_id'       => $order->id,
                        'product_id'     => $item->product?->id,
                        'product_name'   => $item->product?->title,
                        'product_price'  => $item->product?->price,
                        'qty'            => $item->qty,
                    ]);
                }

                // Store billing/shipping addresses
                foreach ($request->post("address") as $type => $address) {
                    $address['type'] = $type; // Add address type (e.g., billing or shipping)
                    $order->addresses()->create($address);
                }
            }

            $cart->empty(); // Clear cart

            DB::commit(); // All good — save changes
            Loggy::success("Order creatd successfully");
        } catch (Throwable $e) {
            DB::rollBack(); // Something failed — undo all DB changes
            Loggy::error(throw $e);
        }

        return to_route('home');
    }
}
