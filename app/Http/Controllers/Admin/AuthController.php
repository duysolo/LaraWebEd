<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\AdminUser;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
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

    var $username, $loginPath, $redirectTo, $redirectPath, $redirectToLoginPage;


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->username = 'username';
        $this->loginPath = 'auth';
        $this->redirectTo = '/'.$this->adminCpAccess.'/dashboard';
        $this->redirectPath = '/'.$this->adminCpAccess.'/dashboard';
        $this->redirectToLoginPage = '/'.$this->adminCpAccess.'/auth/login';

        $this->middleware('guest', ['except' => ['getLogout', 'postLogin', 'getLogin']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return AdminUser::create([
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function authenticated()
    {
        $this->_setFlashMessage('You logged in', 'success');
        $this->_showFlashMessages();
        return redirect()->to($this->redirectTo);
    }

    public function getLogin()
    {
        $this->_unsetLoggedInAdminUser();
        return view('admin.auth.login');
    }

    public function postLogin(Request $request, AdminUser $adminUser)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        $checkAdminUser = $this->_checkAdminUser($credentials, $adminUser);

        if($checkAdminUser != null)
        {
            $adminUser->updateLastLoginTimestamp($checkAdminUser);

            if ($throttles)
            {
                $this->clearLoginAttempts($request);
            }
            $this->_setLoggedInAdminUser($checkAdminUser);
            return $this->authenticated();
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect()->back()
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->with('errorMessages', [
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    public function getLogout()
    {
        $this->_unsetLoggedInAdminUser();
        $this->_setFlashMessage('You now logged out', 'info');
        $this->_showFlashMessages();
        return redirect()->to($this->redirectToLoginPage);
    }

    public function _checkAdminUser($credentials, $adminUser)
    {
        $user = $adminUser->authenticate($credentials['username'], $credentials['password']);

        return $user;
    }
}