<?php

namespace App\Http\Controllers\Fortify;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class TwoFactorAuthCaontroller extends Controller
{
    public function show()
    {
        $user = Auth::guard(Config::get('fortify.guard'))->user();

        return view('two-factor', compact('user'));
    }
}
