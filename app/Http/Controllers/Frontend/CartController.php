<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;

class CartController extends Controller
{

    public function index()
    {
        return Cart::all();
    }
}
