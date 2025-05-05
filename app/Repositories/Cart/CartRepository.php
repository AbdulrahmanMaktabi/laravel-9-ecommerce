<?php

namespace App\Repositories\Cart;

use Illuminate\Support\Collection;
use App\Models\Product;

interface CartRepository
{

    public function get(): Collection;
    public function add(Product $product, $qty = 1);
    public function update(Product $product, $qty);
    public function delete(Product $product);
    public function empty();
    public function total(): float;
}
