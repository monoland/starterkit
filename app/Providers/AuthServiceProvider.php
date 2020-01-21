<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Token;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::guessPolicyNamesUsing(function ($modelClass) {
            return 'App\\Policies\\' . class_basename($modelClass) . 'Policy';
        });

        Resource::withoutWrapping();

        Passport::routes(function ($router) {
            $router->forAccessTokens();
        });

        Passport::loadKeysFrom(storage_path('passkey'));
        Passport::useTokenModel(Token::class);
        Passport::useClientModel(Client::class);
    }
}
