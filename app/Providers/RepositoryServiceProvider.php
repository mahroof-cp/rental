<?php

namespace App\Providers;

use App\Repositories\Permission\PermissionEloquent;
use App\Repositories\Permission\PermissionRepository;
use App\Repositories\Role\RoleEloquent;
use App\Repositories\Role\RoleRepository;
use App\Repositories\User\UserEloquent;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Auth\AuthRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\Settings\SettingsRepository;
use App\Repositories\Settings\SettingsRepositoryInterface;
use App\Repositories\Banner\BannerRepository;
use App\Repositories\Banner\BannerRepositoryInterface;
use App\Repositories\Enquiry\EnquiryRepository;
use App\Repositories\Enquiry\EnquiryRepositoryInterface;
use App\Repositories\Cms\CmsRepository;
use App\Repositories\Cms\CmsRepositoryInterface;
use App\Repositories\Services\ServicesRepository;
use App\Repositories\Services\ServicesRepositoryInterface;
use App\Repositories\Bank\BankEloquent;
use App\Repositories\Bank\BankRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(UserRepository::class, UserEloquent::class);
        $this->app->bind(SettingsRepositoryInterface::class, SettingsRepository::class);
        $this->app->bind(BannerRepositoryInterface::class, BannerRepository::class);
        $this->app->bind(EnquiryRepositoryInterface::class, EnquiryRepository::class);
        $this->app->bind(CmsRepositoryInterface::class, CmsRepository::class);
        $this->app->bind(ServicesRepositoryInterface::class, ServicesRepository::class);
        $this->app->bind(BankRepository::class, BankEloquent::class);
        $this->app->bind(RoleRepository::class, RoleEloquent::class);
        $this->app->bind(PermissionRepository::class, PermissionEloquent::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
