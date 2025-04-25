<?php

namespace App\Http\Requests\Dashboard\Product;

use App\Rules\Dashbaord\ActiveCategory;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;

class ProductUpdateRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

    public Product $product;

    protected function prepareForValidation()
    {
        $this->product = $this->route('product');
    }

    public function rules(): array
    {
        return [
            "store"             => ['required', 'exists:stores,slug'],
            "title"             => ['required', 'unique:products,title,' . $this->product?->id],
            "category"          => ['nullable', 'exists:categories,slug', new ActiveCategory($this->category)],
            "small_description" => ['required'],
            "description"       => ['required'],
            "price"             => ['required', 'numeric'],
            "compare_price"     => ['nullable', 'numeric'],
            "status"            => ['required', 'in:active,inactive,arshived,draft'],
            "featured"          => ['required', 'boolean'],
            "meta_title"        => ['nullable'],
            "meta_links"        => ['nullable'],
            "meta_description"  => ['nullable'],
            "image"             => ['nullable', 'image', 'mimes:png,jpg,jpeg'],
        ];
    }
}
