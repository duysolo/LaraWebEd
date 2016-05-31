<?php
namespace App\Models;

class Brand extends AbstractModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'brands';

    public $timestamps = true;

    /**
     * Primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $rules = [
        'name' => 'string|required|max:255|unique:brands',
        'thumbnail' => 'string|required|max:255',
        'link' => 'string|max:255',
        'status' => 'integer|required|between:0,1',
    ];

    protected $editableFields = [
        'name',
        'thumbnail',
        'link',
        'status',
    ];

    public function product()
    {
        return $this->hasMany('App\Models\Product', 'brand_id');
    }

    public static function deleteItem($id)
    {
        $result = [
            'error' => true,
            'response_code' => 500,
            'message' => 'Some error occurred!',
        ];
        $object = static::find($id);

        if (!$object) {
            $result['message'] = 'The brand you have tried to delete not found';
            return $result;
        }

        $object->product()->sync([]);

        if ($object->delete()) {
            $result['error'] = false;
            $result['response_code'] = 200;
            $result['message'] = ['Delete brand completed!'];
        }

        return $result;
    }
}
