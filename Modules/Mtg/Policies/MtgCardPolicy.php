<?php

namespace Modules\Mtg\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class MtgCardPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
