<?php
namespace App\Models;

use App\Models;

use App\Models\AbstractModel;
use Illuminate\Support\Facades\Validator;

use App\Models\MyInterface;

class Coupon extends AbstractModel implements MyInterface\MultiLanguageInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coupons';

    protected $primaryKey = 'id';

    protected $rules = [
        'global_title' => 'required|max:255',
        'status' => 'integer|required',
        'created_by' => 'integer',
        'coupon_code' => 'required|string|size:10|unique:coupons'
    ];

    protected $editableFields = [
        'global_title',
        'status',
        'order',
        'coupon_code',
        'created_by'
    ];

    public function couponContent()
    {
        return $this->hasMany('App\Models\CouponContent', 'coupon_id');
    }

    public function updateItem($id, $data, $justUpdateSomeFields = false)
    {
        $data['id'] = $id;
        return $this->fastEdit($data, true, $justUpdateSomeFields);
    }

    public function updateItemContent($id, $languageId, $data)
    {
        $result = [
            'error' => true,
            'response_code' => 500,
            'message' => 'Some error occurred!'
        ];

        $coupon = static::find($id);
        if (!$coupon) {
            $result['message'] = 'The coupon you have tried to edit not found.';
            $result['response_code'] = 404;
            return $result;
        }

        /*Update page content*/
        $couponContent = static::getContentById($id, $languageId);
        if (!$couponContent) {
            $couponContent = new CouponContent();
            $couponContent->language_id = $languageId;
            $couponContent->coupon_id = $id;
            $couponContent->save();
        }

        $data['id'] = $couponContent->id;

        return $couponContent->fastEdit($data, false, true);
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

        $temp = CouponContent::where('coupon_id', '=', $id);
        $related = $temp->get();
        if (!count($related)) {
            $related = null;
        }

        /*Remove all related content*/
        if ($related != null) {
            if ($temp->delete()) {
                $result['error'] = false;
                $result['response_code'] = 200;
                $result['message'] = ['Delete related content completed!'];
            }
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
        if (isset($data['coupon_code'])) $dataCoupon['coupon_code'] = $data['coupon_code'];
        if (!isset($data['status'])) $data['status'] = 1;
        if (!isset($data['language_id'])) $data['language_id'] = $language;

        $resultCreateItem = $this->updateItem(0, $dataCoupon);

        /*No error*/
        if (!$resultCreateItem['error']) {
            $coupon_id = $resultCreateItem['object']->id;
            $resultUpdateItemContent = $this->updateItemContent($coupon_id, $language, $data);
            return $resultUpdateItemContent;
        }
        return $resultCreateItem;
    }

    public static function getWithContent($fields = [], $select = [], $order = null, $multiple = false, $perPage = 0)
    {
        $fields = (array)$fields;

        $select = (array)$select;
        if(!$select) $select = ['coupons.status as global_status', 'coupons.coupon_code', 'coupons.global_title', 'coupon_contents.*', 'languages.language_code', 'languages.language_name', 'languages.default_locale'];

        $obj = static::join('coupon_contents', 'coupons.id', '=', 'coupon_contents.coupon_id')
            ->join('languages', 'languages.id', '=', 'coupon_contents.language_id');
        if ($fields && is_array($fields)) {
            foreach ($fields as $key => $row) {
                $obj = $obj->where(function ($q) use ($key, $row) {

                    if ($row['compare'] == 'LIKE') {
                        $q->where($key, $row['compare'], '%' . $row['value'] . '%');
                    } else {
                        $q->where($key, $row['compare'], $row['value']);
                    }
                });
            }
        }
        if ($order && is_array($order)) {
            foreach ($order as $key => $value) {
                $obj = $obj->orderBy($key, $value);
            }
        }
        $obj = $obj->groupBy('coupons.id')
            ->select($select);

        if ($multiple) {
            if ($perPage > 0) return $obj->paginate($perPage);
            return $obj->get();
        }
        return $obj->first();
    }

    public static function getById($id, $languageId = 0, $options = [], $select = [])
    {
        $options = (array)$options;
        $defaultArgs = [
            'status' => 1,
            'global_status' => 1
        ];
        $args = array_merge($defaultArgs, $options);

        $select = (array)$select;
        if(!$select) $select = ['coupons.global_title', 'coupons.status as global_status', 'coupons.coupon_code', 'coupon_contents.*', 'languages.language_code', 'languages.language_name', 'languages.default_locale'];

        return static::join('coupon_contents', 'coupons.id', '=', 'coupon_contents.coupon_id')
            ->join('languages', 'languages.id', '=', 'coupon_contents.language_id')
            ->where('coupons.id', '=', $id)
            ->where(function ($q) use ($args) {
                if ($args['global_status'] != null) $q->where('coupons.status', '=', $args['global_status']);
                if ($args['status'] != null) $q->where('coupon_contents.status', '=', $args['status']);
            })
            ->where('coupon_contents.language_id', '=', $languageId)
            ->select($select)
            ->first();
    }

    public static function getContentById($id, $languageId, $select = [])
    {
        return CouponContent::getBy([
            'coupon_id' => $id,
            'language_id' => $languageId
        ], null, false, 0, $select);
    }
}