<?php
namespace App\Models;

use App\Models;
use App\Models\AbstractModel;

class CouponUserUse extends AbstractModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coupon_user_use';

    public $timestamps = true;

    /**
     * Primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $rules = [
        'coupon_id' => 'min:1|integer|required',
        'user_id' => 'min:1|integer|required',
    ];

    protected $editableFields = [
        'coupon_id',
        'user_id',
    ];

    public function coupon()
    {
        return $this->belongsTo('App\Models\Coupon', 'coupon_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
