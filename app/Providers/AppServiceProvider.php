<?php

namespace App\Providers;


use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\StoreRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Eloquent\StoreRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Services\AuthService;
use App\Services\Contracts\AuthServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use App\Services\Contracts\SellerServiceInterface;
use App\Services\Contracts\StoreServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use App\Services\ProductService;
use App\Services\SellerService;
use App\Services\StoreService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //bind services
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(SellerServiceInterface::class, SellerService::class);
        $this->app->bind(StoreServiceInterface::class, StoreService::class);
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);

        //bind repositories
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(StoreRepositoryInterface::class, StoreRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
