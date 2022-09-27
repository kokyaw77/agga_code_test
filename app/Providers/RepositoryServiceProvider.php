<?php

namespace App\Providers;

use App\Repositories\Zone\ZoneRepository;
use App\Repositories\Zone\ZoneRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\City\CityRepository;
use App\Repositories\City\CityRepositoryInterface;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Ticket\TicketRepository;
use App\Repositories\Ticket\TicketRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
        $this->app->singleton(CityRepositoryInterface::class, CityRepository::class);
        $this->app->singleton(ZoneRepositoryInterface::class, ZoneRepository::class);
        $this->app->singleton(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->singleton(TicketRepositoryInterface::class, TicketRepository::class);
    }
}
