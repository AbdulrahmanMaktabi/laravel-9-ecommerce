<?php

namespace App\View\Components\Dashboard\Product;

use Illuminate\View\Component;
use App\Models\Product;

class ProductForm extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public Product $product;
    public $categories;
    public $tags;
    public $stores;
    public $method;
    public $route;
    public $button;

    public function __construct(Product $product = null, $categories, $tags = null, $stores, $method, $route, $button)
    {
        $this->product = $product ?? new Product();
        $this->categories = $categories;
        $this->tags = $tags ?? null;
        $this->stores = $stores;
        $this->method = $method;
        $this->route = $route;
        $this->button = $button;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.product.product-form');
    }
}
