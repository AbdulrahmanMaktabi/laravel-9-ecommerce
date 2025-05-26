<?php

namespace App\Concerns;

use App\Models\User;
use Illuminate\Support\Facades\Request;

trait HasFilter
{
    /**
     * Filter Scope
     */
    public static function scopeFilter($query, $filters)
    {
        $params = array_merge([
            'name'          => null,
            'email'         => null,
            '2fa_status'    => null,
            'last_active'   => null
        ], $filters);

        $query->when($params['name'], function ($query) use ($params) {
            $query->where('name', 'LIKE', "%{$params['name']}%");
        });

        $query->when($params['email'], function ($query) use ($params) {
            $query->where('email', 'LIKE', "%{$params['email']}%");
        });

        $query->when($params['2fa_status'], function ($query) use ($params) {
            if ($params['2fa_status'] == 'active')
                $query->whereNotNull('two_factor_secret');
        });

        $query->when($params['last_active'], function ($query) use ($params) {
            $query->whereDate('last_active', '<=', $params['last_active']);
        });

        return $query;
    }
}
