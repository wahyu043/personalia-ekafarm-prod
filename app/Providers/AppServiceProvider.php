<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

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
        View::composer('*', function ($view) {
            $isEligibleCuti = false;

            if (Auth::check() && Auth::user()?->karyawan) {
                $isEligibleCuti = Auth::user()->karyawan->isEligibleCuti();
            }

            $view->with('isEligibleCuti', $isEligibleCuti);
        });
    }
}
