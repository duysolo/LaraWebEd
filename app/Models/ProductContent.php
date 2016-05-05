<?php
namespace App\Models;

use App\Models;

use App\Models\AbstractModel;
use Illuminate\Support\Facades\Validator;

class ProductContent extends AbstractModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_contents';

    public $timestamps = true;

    /**
     * Primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $rules = [
        'title' => 'required|max:255',
        'slug' => 'required|max:255|unique_multiple:product_contents,slug,language_id',
        'language_id' => 'min:1|integer|required',
        'description' => 'max:1000',
        'content' => 'string',
        'status' => 'integer|required',
        'thumbnail' => 'string|max:255',
        'tags' => 'string|max:255',
        'price' => 'required|numeric',
        'old_price' => 'numeric'
    ];

    protected $editableFields = [
        'title',
        'slug',
        'language_id',
        'description',
        'content',
        'status',
        'thumbnail',
        'tags',
        'price',
        'old_price'
    ];

    /**
     * Set the relationship
     *
     * @return mixed
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
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