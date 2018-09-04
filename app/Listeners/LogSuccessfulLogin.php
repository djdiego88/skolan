<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

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
        $user = Auth::user();
        if($user->status !== 'disabled'){
            $user->last_access = Carbon::now();
            $user->save();
        }
    }
}
