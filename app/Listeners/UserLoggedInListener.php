<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;

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
