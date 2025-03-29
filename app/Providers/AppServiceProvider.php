<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;
use App\MediaLibrary\CustomPathGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PathGenerator::class, CustomPathGenerator::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
