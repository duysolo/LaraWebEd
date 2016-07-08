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
}