<?php
namespace App\Models;

class ProductAttributeSet extends AbstractModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_attribute_sets';

    public $timestamps = false;

    /**
     * Primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $rules = [
        'title' => 'string|required|max:255',
        'slug' => 'string|required|max:255|unique:product_attribute_sets',
        'status' => 'integer|required|between:0,1',
    ];

    protected $editableFields = [
        'title',
        'slug',
        'status',
    ];

    public function productAttribute()
    {
        return $this->hasMany('App\Models\ProductAttribute', 'attribute_set_id');
    }

    public function productCategory()
    {
        return $this->belongsToMany('App\Models\ProductCategory', 'product_attribute_sets_product_categories', 'attribute_set_id', 'category_id');
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
            $result['message'] = 'The attribute set you have tried to edit not found';
            return $result;
        }

        $resultDeleteProductAttribute = true;
        $resultDeleteProductAttributeProduct = true;

        \DB::beginTransaction();

        $relatedAttributes = [];
        $relatedAttributesObject = $object->productAttribute()->select(['product_attributes.id'])->get();
        if($relatedAttributesObject) {
            foreach ($relatedAttributesObject as $item) {
                $relatedAttributes[] = $item->id;
            }
        }
        if($relatedAttributes) {
            $resultDeleteProductAttribute = ProductAttribute::whereIn('id', $relatedAttributes)->delete();
            $resultDeleteProductAttributeProduct = ProductAttributeProduct::whereIn('attribute_id', $relatedAttributes)->delete();
        }
        $result = $object->delete();

        if($result && $resultDeleteProductAttribute && $resultDeleteProductAttributeProduct) {
            \DB::commit();
            return [
                'error' => false,
                'response_code' => 200,
                'message' => 'Delete attribute set & related attribute completed',
            ];
        } else {
            \DB::rollBack();
        }
        return $result;
    }
}