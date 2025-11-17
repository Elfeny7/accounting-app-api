<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UserService;
use App\Interfaces\User\UserServiceInterface;
use App\Services\TransactionService;
use App\Interfaces\Transaction\TransactionServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(TransactionServiceInterface::class, TransactionService::class);
    }

    public function boot(): void
    {

    }
}
