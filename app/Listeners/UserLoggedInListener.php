<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models;

use Carbon\Carbon;

class UserLoggedInListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    private $event;

    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $this->event = $event;

        $this->_updateLastLoggedIn();
    }

    private function _updateLastLoggedIn()
    {
        $user = $this->event->user;
        $user->last_login_at = Carbon::now();
        $user->save();
    }
}
