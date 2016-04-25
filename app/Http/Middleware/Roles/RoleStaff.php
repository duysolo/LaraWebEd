<?php

namespace App\Http\Middleware\Roles;

use App\Http\Middleware\RolesTrait\Roles;

class RoleStaff
{
    use Roles;
    var $neededRole = 'staff';
    var $allowRole = ['webmaster', 'administrator'];
    var $redirectAdminPath = 'auth/login';
}