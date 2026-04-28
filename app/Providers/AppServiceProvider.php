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
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $activeAds = \App\Models\Advertisement::where('is_active', true)
                ->where(function ($query) {
                    $now = now()->toDateString();
                    $query->whereNull('start_date')
                          ->orWhere('start_date', '<=', $now);
                })
                ->where(function ($query) {
                    $now = now()->toDateString();
                    $query->whereNull('end_date')
                          ->orWhere('end_date', '>=', $now);
                })
                ->get();
            $view->with('activeAds', $activeAds);
        });
    }
}
