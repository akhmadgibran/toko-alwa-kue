<?php

namespace App\Providers;

use App\Models\ShopStatus;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
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
        //
        // Share shop status with all views
        View::composer('*', function ($view) {
            $statusToko = ShopStatus::first();
            // $statusToko = ($statusModel && $statusModel->name === 'open') ? 'open' : 'closed';
            $siteSettings = SiteSetting::first();

            $view->with([
                'statusToko' => $statusToko,
                'siteSettings' => $siteSettings
            ]);
        });
    }
}
