<?php

namespace App\Http\Middleware\Roles;

use App\Http\Middleware\RolesTrait\Roles;

class RoleWebmaster
{
    use Roles;
    var $neededRole = 'webmaster';
    var $allowRole = [];
}
