<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Roles\RoleRepository;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\AdminRepository;
use App\Repositories\Eloquent\ClinicRepository;
use App\Repositories\Eloquent\PetsCategoryRepository;
use App\Repositories\Eloquent\ClinicsCategoryRepository;
use App\Repositories\Eloquent\Contracts\EloquentInterface;
use App\Repositories\Roles\Contracts\RoleRepositoryInterface;
use App\Repositories\Eloquent\Contracts\PetsCategoryInterface;
use App\Repositories\Eloquent\Contracts\AdminRepositoryInterface;
use App\Repositories\Eloquent\Contracts\ClinicInterface;
use App\Repositories\Eloquent\Contracts\ClinicsCategoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    
    public function register()
    {
        
    }

   
    public function boot()
    {
        $this->app->bind(EloquentInterface::class , BaseRepository::class);
        $this->app->bind( AdminRepositoryInterface::class , AdminRepository::class);
        $this->app->bind(RoleRepositoryInterface::class , RoleRepository::class);
        $this->app->bind(ClinicsCategoryInterface::class , ClinicsCategoryRepository::class);
        $this->app->bind(PetsCategoryInterface::class , PetsCategoryRepository::class);
        $this->app->bind(ClinicInterface::class , ClinicRepository::class);
    }
}
