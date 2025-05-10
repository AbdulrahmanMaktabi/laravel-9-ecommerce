<?php

namespace App\Listeners;

use App\Facades\Cart;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class DeductProductQty
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $order = $event->getOrder();

        foreach ($order->products as $product) {
            $product->decrement('qty', $product->pivot->qty);
        }

        // old way to decrement the product qty
        // $order->pivot->qty;
        // foreach (Cart::get() as $item) {
        //     Product::where('id', $item->product->id)
        //         ->update([
        //             'qty' => DB::raw("qty - {$item->qty}")
        //         ]);
        // }
    }
}
