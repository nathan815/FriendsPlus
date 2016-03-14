<?php

namespace FriendsPlus\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use \FriendsPlus\Models;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'status' => \FriendsPlus\Models\Status::class,
            'comment' => \FriendsPlus\Models\Comment::class,
            'like' => \FriendsPlus\Models\Like::class,
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
