<?php

namespace App\Listeners;

use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {

        //logger()->info(json_encode(['event' => $event->user, 'Logged_user' => auth()->user(), 'session' => session('orig_user')]));


        // if event user id and logged in user id doesn't match means they have logged in on behalf. This should not be recorded as real.
        $actual_user = auth()->user();
        $current_user = $event->user;

        if( $current_user->id == $actual_user->id ){
            $current_user->last_login = Carbon::now();
            $current_user->save();
        }


    }
}
