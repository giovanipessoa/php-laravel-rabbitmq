<?php

// app/Infrastructure/Providers/AppServiceProvider.php
namespace App\Infrastructure\Providers;

use AppCore\Application\Repositories\InterfaceProductRepository;
use App\Infrastructure\Persistence\EloquentProductRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // bind interface to its concrete implementation
        $this->app->bind(InterfaceProductRepository::class, EloquentProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
