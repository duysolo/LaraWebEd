<?php
namespace App\Models;

use App\Models;

use App\Models\AbstractModel;
use Illuminate\Support\Facades\Validator;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class User extends AbstractModel implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    public function __construct()
    {
        parent::__construct();
    }

    use Authenticatable, Authorizable, CanResetPassword;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $rules = [
        'email' => 'required|email|unique:users',
        'status' => 'integer',
        'password' => 'string',
        'first_name' => 'string|required',
        'last_name' => 'string',
        'sex' => 'integer|required',
        'description' => 'string|between:0,5000',
        'address' => 'string',
        'avatar' => 'string',
        'phone' => 'numeric|required',
        'phone_2' => 'numeric',
        'phone_3' => 'numeric',
    ];

    protected $editableFields = [
        'email',
        'password',
        'first_name',
        'last_name',
        'sex',
        'description',
        'date_of_birth',
        'address',
        'avatar',
        'phone',
        'phone_2',
        'phone_3',
        'status',
    ];

    public static function getUserByEmail($email)
    {
        $user = static::getBy(['email' => $email]);
        return $user;
    }
}