<?php

// app/Infra/Providers/AppServiceProvider.php
namespace App\Infra\Providers;

use App\Application\Repositories\IProductRepository;
use App\Infra\Repositories\EProductRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // bind interface to its concrete implementation
        $this->app->bind(IProductRepository::class, EProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
