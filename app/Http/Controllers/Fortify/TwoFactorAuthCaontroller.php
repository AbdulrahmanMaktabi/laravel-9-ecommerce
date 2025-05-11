<?php

namespace App\Http\Controllers\Fortify;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorAuthCaontroller extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('two-factor', compact('user'));
    }
}
