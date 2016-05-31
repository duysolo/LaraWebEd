<?php
namespace App\Models;

use App\Models;
use App\Models\AbstractModel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;

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
        'status' => 'integer|between:0,1',
        'password' => 'string|required',
        'first_name' => 'string|required|max:255',
        'last_name' => 'string|max:255',
        'sex' => 'integer|required|between:0,2',
        'description' => 'string|between:0,5000',
        'address' => 'string',
        'avatar' => 'string',
        'phone' => 'numeric',
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

    public function getUserName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
