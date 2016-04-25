<?php

namespace App\Http\Middleware\Roles;

use App\Http\Middleware\RolesTrait\Roles;

class RoleAdmin
{
    use Roles;
    var $neededRole = 'administrator';
    var $allowRole = ['webmaster'];
}
