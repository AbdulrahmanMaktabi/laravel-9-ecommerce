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
    /**
     * Holds the cart items as a Laravel Collection.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $items;

    /**
     * Constructor initializes the $items property as an empty collection.
     * This ensures that $items is always a Collection instance, even before any items are loaded.
     */
    public function __construct()
    {
        $this->items = collect([]);
    }

    /**
     * Retrieves the cart items.
     *
     * If the $items collection is empty, it fetches the cart items from the database
     * where the 'cookie_id' matches the current user's cookie ID.
     * It also eager loads the related 'product' data to minimize database queries.
     *
     * @return \Illuminate\Support\Collection
     */
    public function get(): Collection
    {
        // Check if the items collection is empty
        if (!$this->items->count()) {
            // Fetch cart items from the database with related product data
            $this->items = Cart::with(['product'])
                ->where('cookie_id', Cart::getCookieId())
                ->get();
        }

        // Return the items collection
        return $this->items;
    }

    public function add(Product $product, $qty = 1)
    {
        $cartItem = Cart::where('product_id', $product->id)->first();

        if ($cartItem->exists) {
            $cartItem->increment('qty', $qty);
        } else {
            $cart = Cart::creat([
                'user_id' => Auth::id(),
                'qty' => $qty
            ]);
            $this->get()->push($cart);
        }

        return $cartItem;
    }

    public function update($id,  $qty)
    {
        return Cart::where('id', $id)
            ->update([
                'qty'           => $qty
            ]);
    }

    public function total(): float
    {
        // return (float) Cart::join('products', 'products.id', '=', 'carts.product_id')
        //     ->selectRaw('SUM(products.price * carts.qty) AS total')
        //     ->value('total');

        return $this->get()->sum(function ($item) {
            return $item->qty * $item->product->price;
        });
    }

    public function delete($id)
    {
        Cart::where('id', $id)
            ->delete();
    }

    public function empty()
    {
        Cart::query()
            ->delete();
    }
}
