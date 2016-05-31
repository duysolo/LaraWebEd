<?php
namespace App\Models;

use App\Models;
use App\Models\AbstractModel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Facades\Hash;

class AdminUser extends AbstractModel implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
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
    protected $table = 'admin_users';

    protected $primaryKey = 'id';

    protected $guard = "admin";

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $rules = [
        'username' => 'required|between:5,50|string|unique:admin_users',
        'password' => 'string|required',
        'status' => 'integer|required|between:0,1',
        'user_role_id' => 'integer|required',
    ];

    protected $editableFields = [
        'username',
        'status',
        'password',
        'user_role_id',
    ];

    public function getGuard()
    {
        return $this->guard;
    }

    public function adminUserRole()
    {
        return $this->belongsTo('App\Models\AdminUserRole', 'user_role_id');
    }

    public static function getUserById($id, $options = [])
    {
        $options = (array) $options;
        $defaultArgs = [
            'status' => 1,
        ];
        $args = array_merge($defaultArgs, $options);

        return static::where('id', '=', $id)
            ->where(function ($q) use ($args) {
                if ($args['status'] != null) {
                    $q->where('status', '=', $args['status']);
                }

            })
            ->first();
    }

    public function updateUser($data, $justUpdateSomeFields = true)
    {
        $result = [
            'error' => true,
            'response_code' => 500,
            'message' => 'User not found',
        ];
        if (!$data['id'] || $data['id'] <= 0) {
            return $result;
        }

        if (isset($data['username'])) {
            unset($data['username']);
        }

        if (isset($data['current_password'])) {
            if (!Hash::check($data['current_password'], $this->password)) {
                $result['message'] = 'Old password does not match';
                return $result;
            }
        }

        if ($data['password'] != $data['password_confirmation']) {
            $result['message'] = 'Confirm password does not match';
            return $result;
        }

        if (strlen($data['password']) < 5 || !$data['password']) {
            $result['message'] = 'Min password length is 5 characters.';
            return $result;
        }

        $data['password'] = bcrypt($data['password']);

        $result = $this->fastEdit($data, false, $justUpdateSomeFields);

        return $result;
    }

    public function createUser($data)
    {
        $result = [
            'error' => true,
            'response_code' => 500,
            'message' => 'User not found',
        ];

        if ($data['password'] != $data['password_confirmation']) {
            $result['message'] = 'Confirm password does not match';
            return $result;
        }

        $data['password'] = bcrypt($data['password']);
        $data['username'] = str_slug($data['username'], '_');
        $data['status'] = 1;
        $data['user_role_id'] = 3;

        $user = new static;

        $result = $user->fastEdit($data, true, false);

        return $result;
    }
}
