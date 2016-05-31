<?php
namespace App\Models;

use App\Models;
use App\Models\AbstractModel;

class PageContent extends AbstractModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'page_contents';

    public $timestamps = true;

    /**
     * Primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $rules = [
        'title' => 'required|max:255',
        'slug' => 'required|max:255|unique_multiple:page_contents,slug,language_id',
        'language_id' => 'min:1|integer|required',
        'description' => 'max:1000',
        'content' => 'string',
        'status' => 'integer|required|between:0,1',
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
        'tags',
    ];

    /**
     * Set the relationship
     *
     * @return mixed
     */
    public function page()
    {
        return $this->belongsTo('App\Models\Page', 'page_id');
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
