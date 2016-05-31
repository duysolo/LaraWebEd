<?php namespace App\Models;

use App\Models;

class AdminUserRole extends AbstractModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admin_user_roles';

    public $timestamps = false;

    /**
     * Primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    public function adminUser()
    {
        return $this->hasMany('App\Models\AdminUser', 'user_role_id');
    }
}
