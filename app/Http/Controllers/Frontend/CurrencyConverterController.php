<?php

namespace App\Http\Controllers\Frontend;

use App\Facades\CurrencyConverter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CurrencyConverterController extends Controller
{
    public function calculateRate(Request $request)
    {
        $request->validate([
            'currency_code'         => ['required', 'max:3']
        ]);

        $baseCurrencyCode = config('app.currency');
        $currencyCode = $request->input('currency_code');

        $rate = Cache::get('currency_rate_' . $currencyCode, 0);
        if (!$rate) {
            $converted = CurrencyConverter::convert($baseCurrencyCode, $currencyCode);
            Cache::put('currency_rate_' . $currencyCode, $converted, now()->addMinutes(60));
        }

        Session::put('currency_code', $currencyCode);

        return redirect()->back();
    }
}
