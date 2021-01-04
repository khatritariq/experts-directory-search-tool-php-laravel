<?php

namespace App\Providers;

use App\Repositories\Database\FriendshipRepository;
use App\Repositories\Database\Interfaces\IFriendshipRepository;
use App\Repositories\Database\Interfaces\IMemberRepository;
use App\Repositories\Database\Interfaces\IWebsiteRepository;
use App\Repositories\Database\MemberRepository;
use App\Repositories\Database\WebsiteRepository;
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
        //
        $this->app->bind(
            IMemberRepository::class,
            MemberRepository::class
        );
        $this->app->bind(
            IWebsiteRepository  ::class,
            WebsiteRepository::class
        );
        $this->app->bind(
            IFriendshipRepository::class,
            FriendshipRepository::class
        );
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
