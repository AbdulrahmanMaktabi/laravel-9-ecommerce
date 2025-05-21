<?php

namespace App\Helpers;

use App\Facades\CurrencyConverter;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class Currency
{
    public function __construct(...$parms)
    {
        static::format(...$parms);
    }

    public static function format($amount, $currency = null)
    {
        $formatter = new \NumberFormatter(config('app.locale'), \NumberFormatter::CURRENCY);

        $baseCurrency = config('app.currency', 'USD');

        if ($currency === null)
            $currency = Session::get('currency_code', $baseCurrency);

        if ($baseCurrency != $currency) {
            $rate = Cache::get('currency_code_' . $currency);
            if (!$rate) {
                $rate = CurrencyConverter::convert($baseCurrency, $currency);
            }
            $amount *= $rate;
        }

        return $formatter->formatCurrency($amount, $currency);
    }
}
