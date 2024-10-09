<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use App\Services\User\UserServiceInterface;
use App\Services\User\EloquentUserApiService;
use App\Repositories\User\EloquentUserRepository;
use App\Services\Expense\ExpenseServiceInterface;
use App\Services\Expense\EloquentExpenseApiService;
use App\Repositories\Expense\EloquentExpenseRepository;
use App\Models\Expense;
use App\Policies\ExpensePolicy;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Expense::class => ExpensePolicy::class
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        App::bind(UserServiceInterface::class, function () {
            return new EloquentUserApiService(new EloquentUserRepository());
        });

        App::bind(ExpenseServiceInterface::class, function () {
            return new EloquentExpenseApiService(new EloquentExpenseRepository());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
