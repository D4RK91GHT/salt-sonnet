<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register the lowercase macro
        Str::macro('toLower', function (string $value): string {
            return strtolower($value);
        });

        // Optional: Add a conditional lowercase macro
        Str::macro('toLowerIf', function (string $value, bool $condition = true): string {
            return $condition ? strtolower($value) : $value;
        });
    }
}
