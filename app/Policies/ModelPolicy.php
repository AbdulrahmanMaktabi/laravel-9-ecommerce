<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Str;

class ModelPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct() {}

    public function before($user)
    {
        if ($user->is_super)
            return true;
    }

    public function __call($name, $arguments)
    {
        $user = $arguments[0] ?? null;
        $model = $arguments[1] ?? null;

        $classPrefix = $this->resolveClassPrefix();
        $ability =  $name;

        if ($model && method_exists($model, 'store') && method_exists($user, 'store')) {
            if ($model->store->id !== $user->store->id) {
                return false;
            }
        }
        // dd("$classPrefix.$ability");
        return method_exists($user, 'hasAbility')
            ? $user->hasAbility("$classPrefix.$ability")
            : false;
    }

    private function resolveClassPrefix()
    {
        $baseName = class_basename($this);
        $className = str_replace('Policy', '', $baseName);
        return Str::lower(Str::plural($className));
    }
}
