<?php
namespace App\Models;

class ProductAttributeProduct extends AbstractModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_attributes_products';

    public $timestamps = false;

    /**
     * Primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $rules = [
        'product_id' => 'integer|min:0',
        'attribute_id' => 'integer|min:0',
        'change_price' => 'number',
        'is_percentage' => 'integer|between:0,1',
    ];

    protected $editableFields = [
        'product_id',
        'attribute_id',
        'change_price',
        'is_percentage',
    ];

    public function productAttributeSet()
    {
        return $this->belongsTo('App\Models\ProductAttributeSet', 'attribute_set_id');
    }

    public function product()
    {
        return $this->belongsToMany('App\Models\Product', 'product_attributes_products', 'attribute_id', 'product_id');
    }
}