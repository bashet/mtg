<?php

namespace Modules\Mtg\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Mtg\Entities\MtgCard;
use Modules\Mtg\Entities\MtgOrder;
use Modules\Mtg\Policies\MtgCardPolicy;
use Modules\Mtg\Policies\MtgOrderPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        MtgCard::class => MtgCardPolicy::class,
        MtgOrder::class => MtgOrderPolicy::class
    ];


    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
