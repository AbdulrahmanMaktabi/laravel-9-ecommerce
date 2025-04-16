<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Loggy extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'loggy';
    }
}
