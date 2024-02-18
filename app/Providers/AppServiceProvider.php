<?php

namespace App\Providers;

use App\Contracts\AuthValidatorInterface;
use App\Validators\AuthValidator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            AuthValidatorInterface::class,
            AuthValidator::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Cookie::setDefaultSameSite('None'); 
    }
}
