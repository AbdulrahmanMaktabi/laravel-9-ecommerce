<?php

namespace App\Actions\Fortify;

use App\Facades\Loggy;
use Illuminate\Support\Facades\Config;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Features;
use Laravel\Fortify\Contracts\LoginResponse;


class AuthenticateUser
{

    // This method handles custom authentication logic
    public function authenticate($request)
    {
        $userName = $request->post(Config::get('fortify.username'));
        $password = $request->post('password');

        $guard = Config::get('fortify.guard', 'web');

        $user = $guard === 'admin'
            ? Admin::where('email', $userName)
            ->orWhere('username', $userName)
            ->orWhere('phone', $userName)
            ->first()
            : User::where('email', $userName)
            ->orWhere('name', $userName)
            ->orWhere('phone', $userName)
            ->first();

        if ($user && Hash::check($password, $user->password)) {
            return $user;
        }

        return false;
    }
}
