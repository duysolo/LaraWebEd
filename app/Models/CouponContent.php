<?php
namespace App\Models;

use App\Models;

use App\Models\AbstractModel;
use Illuminate\Support\Facades\Validator;

class CouponContent extends AbstractModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coupon_contents';

    public $timestamps = true;

    /**
     * Primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $rules = [
        'coupon_id' => 'min:1|integer|required',
        'language_id' => 'min:1|integer|required',
        'title' => 'required|max:255',
        'type' => 'integer|required',
        'value' => 'numeric|required',
        'total_quantity' => 'integer|min:0|required',
        'total_used' => 'integer|min:0|required',
        'content' => 'string',
        'apply_for_min_price' => 'numeric|required',
        'thumbnail' => 'string|max:255',
        'status' => 'integer|required',
        'created_by' => 'integer|required',
    ];

    protected $editableFields = [
        'coupon_id',
        'title',
        'type',
        'value',
        'total_quantity',
        'content',
        'apply_for_min_price',
        'thumbnail',
        'status',
        'created_by',
        'expired_at',
    ];

    /**
     * Set the relationship
     *
     * @return mixed
     */
    public function coupon()
    {
        return $this->belongsTo('App\Models\Coupon', 'coupon_id');
    }


    /**
     * Set the relationship
     *
     * @return mixed
     */
    public function language()
    {
        return $this->belongsTo('App\Models\Language', 'language_id');
    }
}