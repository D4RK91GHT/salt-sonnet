<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // $this->loadRoutesFrom(base_path('routes/admin.php'));
        // $this->loadRoutesFrom(base_path('routes/web.php'));
        // $this->loadRoutesFrom(base_path('routes/auth.php'));
        \Illuminate\Support\Facades\Route::middleware('web')->group(base_path('routes/admin.php'));
        \Illuminate\Support\Facades\Route::middleware('web')->group(base_path('routes/api.php'));
        \Illuminate\Support\Facades\Route::middleware('web')->group(base_path('routes/console.php'));
        // \Illuminate\Support\Facades\Route::middleware('web')->group(base_path('routes/web.php'));
        // \Illuminate\Support\Facades\Route::middleware('web')->group(base_path('routes/auth.php'));
    }
}
