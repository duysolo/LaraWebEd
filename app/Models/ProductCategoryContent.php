<?php
namespace App\Models;

use App\Models;

use App\Models\AbstractModel;
use Illuminate\Support\Facades\Validator;

class ProductCategoryContent extends AbstractModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_category_contents';

    public $timestamps = true;

    /**
     * Primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $rules = [
        'title' => 'required|max:255',
        'slug' => 'required|max:255|unique:product_category_contents',
        'language_id' => 'min:1|integer|required',
        'description' => 'max:1000',
        'content' => 'max:5000|string',
        'status' => 'integer|required',
        'thumbnail' => 'string|max:255',
        'tags' => 'string|max:255',
    ];

    protected $editableFields = [
        'title',
        'slug',
        'language_id',
        'description',
        'content',
        'status',
        'thumbnail',
        'tags'
    ];

    /**
     * Set the relationship
     *
     * @return mixed
     */
    public function category()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'category_id');
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