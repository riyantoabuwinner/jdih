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
        if (!app()->runningInConsole()) {
            try {
                $settings = \App\Models\Setting::all()->pluck('value', 'key');
                view()->share('global_settings', $settings);

                $menus = \App\Models\Menu::whereNull('parent_id')
                    ->with('children')
                    ->orderBy('order')
                    ->get()
                    ->groupBy('location');
                view()->share('global_menus', $menus);
            } catch (\Exception $e) {
                // Table might not exist yet
            }
        }
    }
}
