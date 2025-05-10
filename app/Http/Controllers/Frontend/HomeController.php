<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with(['media', 'tags', 'category', 'store'])
            ->Active()
            ->take(5)
            ->get();

        session()->flash('success', 'success message');

        return view('frontend.home', compact(['products']));
    }
}
