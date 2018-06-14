<?php

namespace Modules\User\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        'App\User' => 'Modules\User\Policies\UserPolicy',
    ];


    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
