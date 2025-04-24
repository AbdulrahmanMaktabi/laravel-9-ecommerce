<?php

namespace App\View\Components\Dashboard\Product;

use App\Models\Product;
use Illuminate\View\Component;

class form extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public Product $product;
    public $categories;
    public $stores;
    public $method;
    public $route;
    public $button;

    public function __construct(Product $product = null, $categories, $stores, $method, $route, $button)
    {
        $this->product = $product ?? new Product();
        $this->categories = $categories;
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
        return view('components.dashboard.product.form');
    }
}
