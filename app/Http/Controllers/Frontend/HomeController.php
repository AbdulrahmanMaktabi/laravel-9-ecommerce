<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::select(['id', 'title', 'slug', 'price', 'compare_price', 'category_id', 'store_id'])
            ->with([
                'media',
                'tags:id,name',
                'category:id,name',
                'store:id,name'
            ])
            ->active()
            ->withoutGlobalScope('storeProductsScope')
            ->take(25)
            ->get();

        return view('frontend.home', compact(['products']));
    }
}
