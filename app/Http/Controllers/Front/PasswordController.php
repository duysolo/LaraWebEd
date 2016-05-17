<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class PasswordController extends BaseFrontController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected $linkRequestView = 'front.auth.passwords.send-request';

    protected $resetView = 'front.auth.passwords.reset-password';

    protected $subject = 'Your password reset link';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

        parent::__construct();
    }

    public function getEmail()
    {
        return view($this->linkRequestView);
    }

    //getEmail
    //postEmail
    //getReset
    //postReset
}
