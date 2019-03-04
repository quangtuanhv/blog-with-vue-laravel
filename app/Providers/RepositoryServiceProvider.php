<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    protected static $repositories = [
        'post' => [
            \App\Repositories\Contracts\PostInterface::class,
            \App\Repositories\Eloquent\PostRepository::class,
        ],
        'user' => [
            \App\Repositories\Contracts\UserInterface::class,
            \App\Repositories\Eloquent\UserRepository::class,
        ],
        'role' => [
            \App\Repositories\Contracts\RoleInterface::class,
            \App\Repositories\Eloquent\RoleRepository::class,
        ],
        'tag' => [
            \App\Repositories\Contracts\TagInterface::class,
            \App\Repositories\Eloquent\TagRepository::class,
        ],
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach (static::$repositories as $repository) {
            $this->app->singleton(
                $repository[0],
                $repository[1],
            );
        }
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
