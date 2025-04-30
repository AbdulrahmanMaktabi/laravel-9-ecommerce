<?php

namespace App\Http\Requests\Dashboard\Product;

use App\Rules\Dashbaord\ActiveCategory;
use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
    public function rules()
    {
        return [
            "store"             => ['required', 'exists:stores,slug'],
            "title"             => ['required', 'unique:products,title'],
            'tags'              => ['nullable'],
            "category"          => ['required', 'exists:categories,slug', new ActiveCategory($this->category)],
            "small_description" => ['required'],
            "description"       => ['required'],
            "price"             => ['required', 'numeric'],
            "compare_price"     => ['nullable', 'numeric', 'lt:price'],
            "status"            => ['required', 'in:active,inactive,arshived,draft'],
            "meta_title"        => ['nullable'],
            "meta_links"        => ['nullable'],
            "meta_description"  => ['nullable'],
            "image"             => ['required', 'image', 'mimes:png,jpg,jpeg'],
        ];
    }
}
