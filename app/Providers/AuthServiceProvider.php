<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AuthService;
use App\Services\TokenService;
use App\Interfaces\Auth\AuthServiceInterface;
use App\Interfaces\Auth\TokenServiceInterface;

class AuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(TokenServiceInterface::class, TokenService::class);
    }

    public function boot(): void
    {
        //
    }
}
