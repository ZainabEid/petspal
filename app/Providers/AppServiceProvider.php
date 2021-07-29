<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
   
    public function register()
    {
        $this->app->register(RepositoryServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       Relation::morphMap([
           'clinic' => 'App\Models\Clinic',
           'post' => 'App\Models\Post'
       ]);
    }
}
