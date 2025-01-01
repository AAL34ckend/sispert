<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
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
        // Menggunakan bootstrap 4 untuk pagination
        Paginator::useBootstrapFour();

        // Digunakan untuk mengecek apakah user yang sedang login memiliki role yang diinginkan
        Blade::if('guard', function (array $roles) {
            $isValid = false;
            foreach ($roles as $role) {
                if (Auth::guard($role)->check()) {
                    $isValid = true;
                    break;
                }
            }

            return $isValid;
        });
    }
}
