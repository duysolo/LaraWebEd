<?php
namespace App\Models;

class ProductAttribute extends AbstractModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_attributes';

    public $timestamps = false;

    /**
     * Primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $rules = [
        'attribute_set_id' => 'integer|min:0',
        'name' => 'string|required|max:255',
        'slug' => 'required|max:255|unique_multiple:product_attributes,slug,attribute_set_id',
        'value' => 'string|max:255',
        'order' => 'integer',
    ];

    protected $editableFields = [
        'attribute_set_id',
        'name',
        'slug',
        'order',
        'value',
    ];

    public function productAttributeSet()
    {
        return $this->belongsTo('App\Models\ProductAttributeSet', 'attribute_set_id');
    }

    public function product()
    {
        return $this->belongsToMany('App\Models\Product', 'product_attributes_products', 'attribute_id', 'product_id');
    }

    public function deleteItem($id)
    {
        $result = [
            'error' => true,
            'response_code' => 500,
            'message' => 'Some error occurred!',
        ];
        $object = static::find($id);

        if (!$object) {
            $result['message'] = 'The attribute you have tried to edit not found';
            return $result;
        }

        $resultDeleteProductAttributeProduct = true;

        \DB::beginTransaction();

        $resultDeleteProductAttributeProduct = $object->product()->sync([]);
        $result = $object->delete();

        if($result && $resultDeleteProductAttributeProduct) {
            \DB::commit();
            return [
                'error' => false,
                'response_code' => 200,
                'message' => 'Delete attribute completed',
            ];
        } else {
            \DB::rollBack();
        }
        return $result;
    }
}