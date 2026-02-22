<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */

    // public const HOME = '/';

    // Por esto:
    // public const HOME = '/dashboard';
    public const HOME = '/admin';

    /**
     * Lógica de redirección por Rol
     * Se coloca aquí para que sea accesible globalmente
     */
    // public static function redirectTo()
    // {
    //     /** @var \App\Models\User|null $user */
    //     $user = Auth::user();

    //     if ($user->hasRole('admin')) {
    //         return '/admin';
    //     }

    //     if ($user->hasRole('cliente')) {
    //         // Mandamos al cliente a su perfil ya que no tiene permisos de admin
    //         return '/admin/user/profile';
    //     }

    //     return self::HOME;
    // }

    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('web', 'auth')
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
