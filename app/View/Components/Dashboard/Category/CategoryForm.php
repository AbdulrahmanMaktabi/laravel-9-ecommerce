<?php

namespace App\View\Components\Dashboard\Category;

use Illuminate\View\Component;
use App\Models\Category;

class CategoryForm extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public Category $category;
    public $categories;
    public $method;
    public $route;
    public $button;

    public function __construct(Category $category = null, $categories, $method = '', $route, $button = 'Create')
    {
        $this->category = $category ?? new Category();
        $this->categories = $categories;
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
        return view('components.dashboard.category.category-form');
    }
}
