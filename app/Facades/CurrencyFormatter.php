<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CurrencyFormatter extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'currencyFormatter';
    }
}
