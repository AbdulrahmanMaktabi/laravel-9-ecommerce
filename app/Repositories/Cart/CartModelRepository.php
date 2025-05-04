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
        return Cart::create([
            'user_id'           => Auth()->id(),
            'cookie_id'         => $this->getCookieId(),
            'qty'               => $qty,
            'product_id'        => $product->id
        ]);
    }

    public function update(Product $product, $qty)
    {
        return Cart::where('cookie_Id', $this->getCookieId())
            ->where('product_id', $product->id)
            ->update([
                'qty'           => $qty
            ]);
    }

    public function total()
    {
        return Cart::where('cookie_id', '')
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
            ->destroy();
    }

    public function getCookieId()
    {
        $cookieId = Cookie::get('cookie_id');

        if (!$cookieId) {
            $cookieId = Cookie::queue('cookie_id', Str::uuid(), Carbon::now()->addDays(30));
        }

        return $cookieId;
    }
}
