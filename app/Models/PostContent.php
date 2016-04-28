<?php
namespace App\Models;

use App\Models;

use App\Models\AbstractModel;
use Illuminate\Support\Facades\Validator;

class PostContent extends AbstractModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'post_contents';

    public $timestamps = true;

    /**
     * Primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $rules = [
        'title' => 'required|max:255',
        'slug' => 'required|max:255|unique:post_contents',
        'language_id' => 'min:1|integer|required',
        'description' => 'max:1000',
        'content' => 'max:500000|string',
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
    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id');
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