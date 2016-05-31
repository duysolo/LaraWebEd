<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
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

    protected $redirectPath;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

        parent::__construct();

        $this->redirectPath = $this->_getHomepageLink();
    }

    public function getEmail()
    {
        return view($this->linkRequestView);
    }

    //getEmail
    //postEmail
    //getReset
    //postReset

    protected function getResetValidationRules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|between:5,32',
        ];
    }

    /**
     * Get the response for after a successful password reset.
     *
     * @param  string  $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getResetSuccessResponse($response)
    {
        $this->_setFlashMessage(trans($response), 'success');
        $this->_showFlashMessages();
        return redirect($this->redirectPath());
    }

    /**
     * Get the response for after a failing password reset.
     *
     * @param  Request  $request
     * @param  string  $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getResetFailureResponse(Request $request, $response)
    {
        $this->_setFlashMessage(trans($response), 'success');
        $this->_showFlashMessages();
        return redirect()->back()
            ->withInput($request->only('email'));
    }
}
