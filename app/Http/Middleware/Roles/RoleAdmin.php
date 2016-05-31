<?php

namespace App\Http\Middleware\Roles;

use App\Http\Middleware\RolesTrait\Roles;

class RoleAdmin
{
    use Roles;
    public $neededRole = 'administrator';
    public $allowRole = ['webmaster'];
}
