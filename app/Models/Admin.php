<?php

namespace App\Models;

use App\Concerns\HasFilter;
use App\Concerns\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;

class Admin extends User
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable, HasRoles, HasFilter;

    protected $table = 'admins';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
