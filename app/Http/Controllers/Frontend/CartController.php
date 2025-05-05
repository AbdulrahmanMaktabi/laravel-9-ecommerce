<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    protected $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        return view('frontend.cart', [
            'cart' => $this->cart->get(),
            'total' => $this->cart->total()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'nullable|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        $qty = $request->qty ?? 1;

        $this->cart->add($product, $qty);

        return redirect()->route('cart.index')
            ->with('success', 'Product added to cart successfully');
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'qty' => 'required|integer|min:1'
        ]);

        $this->cart->update($product, $request->qty);

        return redirect()->route('cart.index')
            ->with('success', 'Cart updated successfully');
    }

    public function destroy(Product $product)
    {
        $this->cart->delete($product);

        return redirect()->route('cart.index')
            ->with('success', 'Product removed from cart successfully');
    }

    public function empty()
    {
        $this->cart->empty();

        return redirect()->route('cart.index')
            ->with('success', 'Cart emptied successfully');
    }
}
