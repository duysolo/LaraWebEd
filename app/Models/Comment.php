<?php
namespace App\Models;

class Comment extends AbstractModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    public $timestamps = true;

    /**
     * Primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $rules = [
        'parent_id' => 'integer',
        'from_user_id' => 'integer',
        'rating_id' => 'integer',
        'related_id' => 'integer',
        'comment_to' => 'string|max:255',
        'name' => 'required|between:3,100',
        'phone' => 'numeric|required',
        'email' => 'required|email',
        'title' => 'string|max:255',
        'content' => 'string|required|between:10,5000',
        'status' => 'integer|between:0,1',
    ];

    protected $editableFields = [
        'parent_id',
        'from_user_id',
        'rating_id',
        'related_id',
        'comment_to',
        'name',
        'phone',
        'email',
        'title',
        'content',
        'status',
    ];

    public function parent()
    {
        return $this->belongsTo('App\Models\Comment', 'parent_id');
    }

    public function child()
    {
        return $this->hasMany('App\Models\Comment', 'parent_id');
    }

    public function postContent()
    {
        return $this->belongsTo('App\Models\PostContent', 'related_id');
    }

    public function pageContent()
    {
        return $this->belongsTo('App\Models\PageContent', 'related_id');
    }

    public function categoryContent()
    {
        return $this->belongsTo('App\Models\CategoryContent', 'related_id');
    }

    public function productContent()
    {
        return $this->belongsTo('App\Models\ProductContent', 'related_id');
    }

    public function productCategoryContent()
    {
        return $this->belongsTo('App\Models\ProductCategoryContent', 'related_id');
    }

    public function getRelatedObject()
    {
        switch ($this->comment_to) {
            case 'page': {
                return $this->pageContent();
            }
                break;
            case 'post': {
                return $this->postContent();
            }
                break;
            case 'category': {
                return $this->categoryContent();
            }
                break;
            case 'product': {
                return $this->productContent();
            }
                break;
            case 'productCategory': {
                return $this->productCategoryContent();
            }
                break;
        }
        return null;
    }

    public static function deleteComment($id)
    {
        $result = [
            'error' => true,
            'response_code' => 500,
            'message' => 'Some error occurred!',
        ];
        $object = static::find($id);

        if (!$object) {
            $result['message'] = 'The comment you have tried to edit not found';
            return $result;
        }

        \DB::beginTransaction();

        if ($object->child()->delete() && $object->delete()) {
            $result['error'] = false;
            $result['response_code'] = 200;
            $result['message'] = ['Delete comment completed!'];
            \DB::commit();
        }
        \DB::rollBack();

        return $result;
    }
}
