<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Contracts\Repositories\InstancesRepository::class, \App\Repositories\Eloquent\InstancesRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\CompaniesRepository::class, \App\Repositories\Eloquent\CompaniesRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\RepositoriesRepository::class, \App\Repositories\Eloquent\RepositoriesRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\DocumentRepository::class, \App\Repositories\Eloquent\DocumentRepositoryEloquent::class);
        //:end-bindings:
    }
}
