<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogService
{
    protected static function formatMessage($message)
    {
        $user = Auth::check() ? 'User ID: ' . Auth::user() : 'Guest User';

        return 'Time: ' . Carbon::now() . ' | ' . $user . ' | Message: ' . $message;
    }

    public static function error($message)
    {
        Log::channel('error_single')->error(self::formatMessage($message));
    }

    public static function success($message)
    {
        Log::channel('success_single')->info(self::formatMessage($message));
    }
}
