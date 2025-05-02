<?php

namespace App\Models\Scopes\Dashboard;

use App\Facades\Loggy;
use App\Models\Store;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class StoreProducts implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $user = Auth::user();

        if (!$user) {
            Loggy::warning("Guest tried to access products. Skipping StoreProducts scope.");
            return;
        }

        $store = Store::Active()
            ->where('user_id', $user->id)
            ->first();

        if (!$store) {
            Loggy::error("No active store found for user ID: {$user->id} in StoreProducts scope.");
            return;
        }

        $builder->where('store_id', $store->id);
    }
}
