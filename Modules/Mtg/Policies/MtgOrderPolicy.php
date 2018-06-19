<?php

namespace Modules\Mtg\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MtgOrderPolicy
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

    public function see_all_orders(User $user){
        return $user->isAllowed('see_all_orders');
    }
}
