<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartModelRepository implements CartRepository
{
    public function get(): Collection
    {
        return Cart::where('cookie_id', Cart::getCookieId())
            ->get();
    }

    public function add(Product $product, $qty = 1)
    {
        $cartItem = Cart::where('product_id', $product->id)->first();

        if ($cartItem->exists) {
            $cartItem->increment('qty', $qty);
        } else {
            Cart::creat([
                'user_id' => Auth::id(),
                'qty' => $qty
            ]);
        }

        return $cartItem;
    }

    public function update(Product $product, $qty)
    {
        return Cart::where('product_id', $product->id)
            ->update([
                'qty'           => $qty
            ]);
    }

    public function total(): float
    {
        return (float) Cart::join('products', 'products.id', '=', 'carts.product_id')
            ->selectRaw('SUM(products.price * carts.qty) AS total')
            ->value('total');
    }

    public function delete(Product $product)
    {
        Cart::where('product_Id', $product->id)
            ->delete();
    }

    public function empty()
    {
        Cart::query()
            ->delete();
    }
}
