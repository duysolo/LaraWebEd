<?php
namespace App\Models;

use App\Models;

use App\Models\AbstractModel;
use Illuminate\Support\Facades\Validator;

class Coupon extends AbstractModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coupons';

    public $timestamps = true;

    /**
     * Primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $rules = [
        'coupon_code' => 'required|string|size:10|unique:coupons',
        'language_id' => 'min:1|integer|required',
        'title' => 'required|max:255',
        'type' => 'integer|required',
        'value' => 'numeric|required',
        'total_quantity' => 'integer|min:0|required',
        'total_used' => 'integer|min:0',
        'content' => 'string',
        'apply_for_min_price' => 'numeric|required',
        'thumbnail' => 'string|max:255',
        'status' => 'integer|required',
        'created_by' => 'integer|required',
    ];

    protected $editableFields = [
        'coupon_code',
        'language_id',
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
    
    public function language()
    {
        return $this->belongsTo('App\Models\Language', 'language_id');
    }

    public function updateItem($id, $data, $justUpdateSomeFields = false)
    {
        $data['id'] = $id;
        return $this->fastEdit($data, true, $justUpdateSomeFields);
    }

    public static function deleteItem($id)
    {
        $result = [
            'error' => true,
            'response_code' => 500,
            'message' => 'Some error occurred!'
        ];
        $object = static::find($id);

        if (!$object) {
            $result['message'] = 'The coupon you have tried to edit not found';
            return $result;
        }

        if ($object->delete()) {
            $result['error'] = false;
            $result['response_code'] = 200;
            $result['message'] = ['Delete coupon completed!'];
        }

        return $result;
    }

    public function createItem($language, $data)
    {
        $dataCoupon = ['status' => 1];
        if (isset($data['title'])) $dataCoupon['global_title'] = $data['title'];
        if (!isset($data['status'])) $data['status'] = 1;
        if (!isset($data['language_id'])) $data['language_id'] = $language;

        $resultCreateItem = $this->updateItem(0, $dataCoupon);

        return $resultCreateItem;
    }

    public static function getById($id, $options = [], $select = [])
    {
        $options = (array)$options;
        $defaultArgs = [
            'status' => 1
        ];
        $args = array_merge($defaultArgs, $options);

        $select = (array)$select;
        if(!$select) $select = ['coupons.global_title', 'coupons.*', 'languages.language_code', 'languages.language_name', 'languages.default_locale'];

        return static::join('languages', 'languages.id', '=', 'coupon_contents.language_id')
            ->where('coupons.id', '=', $id)
            ->where(function ($q) use ($args) {
                if ($args['status'] != null) $q->where('coupons.status', '=', $args['status']);
            })
            ->select($select)
            ->first();
    }

    public static function getContentById($id, $languageId, $select = [])
    {
        return static::getBy([
            'coupon_id' => $id,
            'language_id' => $languageId
        ], null, false, 0, $select);
    }
}