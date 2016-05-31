<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\BaseFrontController;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

class AuthController extends BaseFrontController
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
     */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    public $username, $loginPath, $redirectPath, $redirectToLoginPage;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->username = 'email';

        /**
         * Where to redirect users after login / registration.
         *
         * @var string
         */
        $this->redirectPath = $this->_getHomepageLink();

        $this->redirectToLoginPage = '/' . $this->currentLanguageCode . '/auth/login';

        $this->middleware('guest', ['except' => ['getLogout']]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = new User();
        $result = $user->fastEdit([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ], true, false);
        return $result;
    }

    public function postRegister(Request $request, User $object)
    {
        $data = [
            'first_name' => $request->get('first_name', null),
            'last_name' => $request->get('last_name', null),
            'email' => $request->get('email', null),
            'sex' => $request->get('sex', 0),
            'password' => $request->get('password', null),
            'password_confirmation' => $request->get('password_confirmation', null),
            'status' => 1,
        ];

        $validate = $this->_validateRegister($data);

        if (!$validate) {
            return redirect()->back()->withInput();
        }

        $data['password'] = bcrypt($data['password']);
        $result = $object->fastEdit($data, true, false);

        if ($result['error']) {
            $this->_setFlashMessage($result['message'], 'error');
            $this->_showFlashMessages();

            return redirect()->back()->withInput();
        }

        auth($this->getGuard())->login($result['object']);

        $this->_setFlashMessage('You now logged in', 'success');

        $this->_showFlashMessages();

        return redirect($this->redirectPath());
    }

    private function _validateRegister($data)
    {
        $validateUser = new User();
        $validateUser->extendRules([
            'password' => 'string|required|between:5,32|confirmed',
        ]);
        if (!$validateUser->validateData($data)) {
            $errors = $validateUser->getErrors();
            $this->_setFlashMessage($errors, 'error');
            $this->_showFlashMessages();
            return false;
        }
        return true;
    }

    public function getLogin(User $user)
    {
        auth()->logout();

        $this->_setPageTitle('Login');

        $this->_loadFrontMenu();

        return $this->_viewFront('auth.login');
    }

    /**
     * Get the failed login response instance.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $this->_setFlashMessage($this->getFailedLoginMessage(), 'error');
        $this->_showFlashMessages();
        return redirect()->back()
            ->withInput($request->only($this->loginUsername(), 'remember'));
    }

    protected function authenticated()
    {
        $this->_setFlashMessage('You now logged in', 'info');
        $this->_showFlashMessages();
        return redirect($this->redirectPath());
    }

    public function getLogout(User $user)
    {
        auth()->logout();
        $this->_setFlashMessage('You now logged out', 'info');
        $this->_showFlashMessages();
        return redirect()->to($this->redirectToLoginPage);
    }

    public function getRegister()
    {
        $this->_setPageTitle('Register');
        $this->_loadFrontMenu();
        return $this->_viewFront('auth.register');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        $credentials['status'] = 1;

        if (\Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        if ($throttles && !$lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
    }
}
