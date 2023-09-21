<?php

namespace App\Providers;

use App\Repositories\CategoryRepository;
use App\Repositories\CrudRepository;
use App\Repositories\EloquentCrudRepository;
use App\Repositories\ModelRepositoryInterface;
use App\Repositories\NewsRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(abstract: NewsRepository::class, concrete: ModelRepositoryInterface::class);
        $this->app->bind(abstract: UserRepository::class, concrete: ModelRepositoryInterface::class);
        $this->app->bind(abstract: CategoryRepository::class, concrete: ModelRepositoryInterface::class);
        $this->app->bind(EloquentCrudRepository::class, CrudRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
