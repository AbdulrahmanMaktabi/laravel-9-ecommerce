<?php

namespace App\Rules\Dashbaord;

use App\Models\Category;
use Illuminate\Contracts\Validation\Rule;

class ActiveCategory implements Rule
{
    protected Category $category;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($categorySlug)
    {
        $this->category = Category::where('slug', $categorySlug)->first();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->category && $this->category->status == 'active';
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The category status is not active .';
    }
}
