<?php

namespace App\Providers;

use App\Repositories\RepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Models\Category;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Registrar el repositorio de categorías
        $this->app->bind(CategoryRepository::class, function ($app) {
            return new CategoryRepository(new Category());
        });

        // Registrar la interfaz del repositorio
        $this->app->bind(RepositoryInterface::class, CategoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
