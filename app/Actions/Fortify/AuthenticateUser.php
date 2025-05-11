<?php

namespace App\Actions\Fortify;

use App\Facades\Loggy;
use Illuminate\Support\Facades\Config;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{

    // This method handles custom authentication logic
    public function authenticate($request)
    {
        // Get the username field name from config (default: 'email')
        $userName = $request->post(Config::get('fortify.username'));

        // Get the submitted password
        $password = $request->post('password');

        // Find the admin user by email OR username OR phone
        $user = Admin::where('email', $userName)
            ->orWhere('username', $userName)
            ->orWhere('phone', $userName)
            ->first();

        // If user is found and password matches
        if ($user && Hash::check($password, $user->password)) {
            return $user;

            Loggy::success("Log in the user using the 'admin' guard id | #{$user->id}");
        }

        return false;
    }
}
