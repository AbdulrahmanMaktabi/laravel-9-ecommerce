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
        return Cart::where('cookie_id', $this->getCookieId())
            ->get();
    }

    public function add(Product $product, $qty = 1)
    {
        $cartItem = Cart::firstOrNew([
            'product_id' => $product->id,
            'cookie_id' => $this->getCookieId()
        ]);

        if ($cartItem->exists) {
            $cartItem->increment('qty', $qty);
        } else {
            $cartItem->fill([
                'user_id' => Auth::id(),
                'qty' => $qty + 1
            ])->save();
        }

        return $cartItem;
    }

    public function update(Product $product, $qty)
    {
        return Cart::where('cookie_Id', $this->getCookieId())
            ->where('product_id', $product->id)
            ->update([
                'qty'           => $qty
            ]);
    }

    public function total(): float
    {
        return (float) Cart::where('cookie_id', $this->getCookieId())
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->selectRaw('SUM(products.price * carts.qty) AS total')
            ->value('total');
    }

    public function delete(Product $product)
    {
        Cart::where('cookie_id', $this->getCookieId())
            ->where('product_Id', $product->id)
            ->delete();
    }

    public function empty()
    {
        Cart::where('cookie_id', $this->getCookieId())
            ->delete();
    }

    protected function getCookieId()
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
