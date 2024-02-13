<?php

namespace App\Providers;

use App\Models\File;
use App\Services\File\FileService;
use App\Services\Zip\ZipService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(FileService::class, function() {
            return new FileService();
        });

        $this->app->singleton(ZipService::class, function () {
            return new ZipService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
