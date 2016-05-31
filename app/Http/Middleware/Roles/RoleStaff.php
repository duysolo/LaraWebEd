<?php

namespace App\Http\Middleware\Roles;

use App\Http\Middleware\RolesTrait\Roles;

class RoleStaff
{
    use Roles;
    public $neededRole = 'staff';
    public $allowRole = ['webmaster', 'administrator'];
    public $redirectAdminPath = 'auth/login';
}
