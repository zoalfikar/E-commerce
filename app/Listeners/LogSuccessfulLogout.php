<?php

namespace App\Listeners;

use App\Events\UserLoginLogout;
use Illuminate\Auth\Events\Logout;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LogSuccessfulLogout
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
     * @param  object  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        Cache::forget('user_'.Auth::user()->id);
        Cache::decrement('active_users');
        event(new UserLoginLogout());
    }
}
