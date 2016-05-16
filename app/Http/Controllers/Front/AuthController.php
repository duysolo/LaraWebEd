<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\BaseFrontController;
use App\Models\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

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

    var $username, $loginPath, $redirectTo, $redirectPath, $redirectToLoginPage;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->username = 'email';
        $this->loginPath = 'auth';

        /**
         * Where to redirect users after login / registration.
         *
         * @var string
         */
        $this->redirectTo = '/'.$this->currentLanguageCode;

        $this->redirectPath = '/'.$this->currentLanguageCode;
        $this->redirectToLoginPage = '/'.$this->currentLanguageCode.'/auth/login';

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
            'name' => 'required|max:255',
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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getLogin(User $user)
    {
        auth()->logout();

        $this->_loadFrontMenu();
        
        return $this->_viewFront('auth.login');
    }

    protected function authenticated()
    {
        return redirect()->to($this->redirectTo);
    }

    public function getLogout(User $user)
    {
        auth()->logout();
        $this->_setFlashMessage('You now logged out', 'info');
        $this->_showFlashMessages();
        return redirect()->to($this->redirectToLoginPage);
    }
}
