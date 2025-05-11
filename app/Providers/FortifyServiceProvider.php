<?php

namespace App\Providers;

// Import custom Fortify action classes
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;

// Import necessary Laravel classes
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // If the request is under the "admin/*" route
        if (request()->is('admin/*')) {
            // Set the guard to 'admin' for admin routes
            Config::set('fortify.guard', 'admin');

            // Set the Fortify route prefix to 'admin'
            Config::set('fortify.prefix', 'admin');

            // Set the password broker to use 'admins'
            Config::set('fortify.passwords', 'admins');

            // Set the post-login redirection for admins
            Config::set('fortify.home', 'admin/dashboard');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Tell Fortify to use a custom class to create users
        Fortify::createUsersUsing(CreateNewUser::class);

        // Custom handler for updating profile info
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);

        // Custom handler for updating user passwords
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);

        // Custom handler for resetting passwords
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // Rate limiter for login attempts: 5 per minute per IP and username
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(
                Str::lower($request->input(Fortify::username())) . '|' . $request->ip()
            );

            return Limit::perMinute(5)->by($throttleKey);
        });

        // Rate limiter for two-factor authentication: 5 per minute per session
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        /**
         * Views customization section
         */

        // Set the view prefix depending on the guard (frontend or admin)
        if (Config::get('fortify.guard') == 'web')
            Fortify::viewPrefix('frontend.auth.'); // For frontend views
        else
            Fortify::viewPrefix('auth.'); // For admin or others

        // Alternatively, you can define each Fortify view separately:
        // Fortify::loginView('auth.login');
        // Fortify::registerView('auth.register');
        // Fortify::requestPasswordResetLinkView('auth.reset-password');
    }
}
