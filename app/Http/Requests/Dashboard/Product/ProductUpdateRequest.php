<?php

namespace App\Http\Requests\Dashboard\Product;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules(): array
    {
        return [
            "store" => ['required', 'exists:stores,slug'],
            "title" => ['required', 'unique:products,title'],
            "category" => ['nullable', 'exists:categories,slug'],
            "small_description" => ['required'],
            "description" => ['required'],
            "price" => ['required', 'numeric'],
            "compain_price" => ['nullable', 'numeric'],
            "status" => ['required', 'in:active,inactive,arshived,draft'],
            "meta_title" => ['nullable'],
            "meta_links" => ['nullable'],
            "meta_description" => ['nullable'],
            "image" => ['nullable', 'image', 'mimes:png,jpg,jpeg'],
        ];
    }
}
