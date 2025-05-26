<?php

namespace App\Observers;

use App\Http\Controllers\Backend\RoleController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isEmpty;

class userObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //
    }

    public function creating(User $user)
    {
        if (isEmpty($user->slug))
            $user->update(['slug', Str::slug($user->name)]);

        $role = Role::where('name', 'Normal User')->firstOrFail();

        $user->roles()->sync($role->id);
    }

    public function updating(User $user)
    {
        if ($user->isDirty($user->name))
            $user->update(['slug', Str::slug($user->name)]);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
