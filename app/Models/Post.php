<?php
namespace App\Models;

use App\Models;
use App\Models\AbstractModel;
use App\Models\Category;
use App\Models\Contracts;

class Post extends AbstractModel implements Contracts\MultiLanguageInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    protected $primaryKey = 'id';

    protected $rules = [
        'global_title' => 'required|max:255',
        'status' => 'integer|required|between:0,1',
        'created_by' => 'integer',
        'is_popular' => 'integer|between:0,1',
        'order' => 'integer',
    ];

    protected $editableFields = [
        'global_title',
        'status',
        'order',
        'page_template',
        'created_by',
        'is_popular',
    ];

    public function postContent()
    {
        return $this->hasMany('App\Models\PostContent', 'post_id');
    }

    public function adminUser()
    {
        return $this->belongsTo('App\Models\AdminUser', 'created_by');
    }

    public function category()
    {
        return $this->belongsToMany('App\Models\Category', 'categories_posts', 'post_id', 'category_id');
    }

    public function updateItem($id, $data, $justUpdateSomeFields = false)
    {
        $data['id'] = $id;
        $result = $this->fastEdit($data, true, $justUpdateSomeFields);

        if (!$result['error']) {
            /*Save categories*/
            if (isset($data['category_ids'])) {
                $result['object']->category()->sync($data['category_ids']);
            }
        }
        return $result;
    }

    public function updateItemContent($id, $languageId, $data)
    {
        $result = [
            'error' => true,
            'response_code' => 500,
            'message' => 'Some error occurred!',
        ];

        $post = static::find($id);
        if (!$post) {
            $result['message'] = 'The post you have tried to edit not found.';
            $result['response_code'] = 404;
            return $result;
        }

        if (isset($data['slug'])) {
            $data['slug'] = str_slug($data['slug']);
        }

        /*Save categories*/
        if (isset($data['category_ids'])) {
            $post->category()->sync($data['category_ids']);
        }

        /*Update page template*/
        if (isset($data['page_template'])) {
            $post->page_template = $data['page_template'];
            $post->save();
        }

        /*Update post content*/
        $postContent = static::getContentById($id, $languageId);
        if (!$postContent) {
            $postContent = new PostContent();
            $postContent->language_id = $languageId;
            $postContent->post_id = $id;
            $postContent->save();
        }

        $data['id'] = $postContent->id;

        return $postContent->fastEdit($data, false, true);
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
            $result['message'] = 'The post you have tried to edit not found';
            return $result;
        }

        $temp = PostContent::where('post_id', '=', $id);
        $related = $temp->get();
        if (!count($related)) {
            $related = null;
        }

        /*Remove all related content*/
        if ($related != null) {
            PostMeta::join('post_contents', 'post_contents.id', '=', 'post_metas.content_id')
                ->join('posts', 'posts.id', '=', 'post_contents.post_id')
                ->where('posts.id', '=', $id)
                ->delete();

            $temp->delete();
        }

        $object->category()->sync([]);

        if ($object->delete()) {
            $result['error'] = false;
            $result['response_code'] = 200;
            $result['message'] = ['Delete post completed!'];
        }

        return $result;
    }

    public function createItem($language, $data)
    {
        $dataPost = ['status' => 1];
        if (isset($data['title'])) {
            $dataPost['global_title'] = $data['title'];
        }

        if (isset($data['created_by'])) {
            $dataPost['created_by'] = $data['created_by'];
        }

        if (isset($data['category_ids'])) {
            $dataPost['category_ids'] = $data['category_ids'];
        }

        if (!isset($data['status'])) {
            $data['status'] = 1;
        }

        if (!isset($data['language_id'])) {
            $data['language_id'] = $language;
        }

        $resultCreateItem = $this->updateItem(0, $dataPost);

        /*No error*/
        if (!$resultCreateItem['error']) {
            $post_id = $resultCreateItem['object']->id;
            $resultUpdateItemContent = $this->updateItemContent($post_id, $language, $data);
            if ($resultUpdateItemContent['error']) {
                $this->deleteItem($resultCreateItem['object']->id);
            }
            return $resultUpdateItemContent;
        }
        return $resultCreateItem;
    }

    public static function getWithContent($fields = [], $select = [], $order = null, $multiple = false, $perPage = 0)
    {
        $fields = (array) $fields;
        $select = (array) $select;

        if (!$select) {
            $select = [
                'posts.status as global_status',
                'posts.page_template',
                'posts.global_title',
                'post_contents.*',
                'posts.id',
                'post_contents.id as content_id',
                'languages.language_code',
                'languages.language_name',
                'languages.default_locale'
            ];
        }

        $obj = static::join('post_contents', 'posts.id', '=', 'post_contents.post_id')
            ->join('languages', 'languages.id', '=', 'post_contents.language_id');
        if ($fields && is_array($fields)) {
            foreach ($fields as $key => $row) {
                $obj = $obj->where(function ($q) use ($key, $row) {
                    switch ($row['compare']) {
                        case 'LIKE':{
                                $q->where($key, $row['compare'], '%' . $row['value'] . '%');
                            }break;
                        case 'IN':{
                                $q->whereIn($key, (array) $row['value']);
                            }break;
                        case 'NOT_IN':{
                                $q->whereNotIn($key, (array) $row['value']);
                            }break;
                        default:{
                                $q->where($key, $row['compare'], $row['value']);
                            }break;
                    }
                });
            }
        }
        if ($order && is_array($order)) {
            foreach ($order as $key => $value) {
                $obj = $obj->orderBy($key, $value);
            }
        }
        if ($order == 'random') {
            $obj = $obj->orderBy(\DB::raw('RAND()'));
        }

        $obj = $obj->groupBy('posts.id')
            ->select($select);

        if ($multiple) {
            if ($perPage > 0) {
                return $obj->paginate($perPage);
            }

            return $obj->get();
        }
        return $obj->first();
    }

    public static function getById($id, $languageId, $options = [], $select = [])
    {
        $options = (array) $options;
        $defaultArgs = [
            'status' => 1,
            'global_status' => 1,
        ];
        $args = array_merge($defaultArgs, $options);

        $select = (array) $select;
        if (!$select) {
            $select = [
                'posts.status as global_status',
                'posts.page_template',
                'posts.global_title',
                'post_contents.*',
                'posts.id',
                'post_contents.id as content_id',
                'languages.language_code',
                'languages.language_name',
                'languages.default_locale'
            ];
        }

        return static::join('post_contents', 'posts.id', '=', 'post_contents.post_id')
            ->join('languages', 'languages.id', '=', 'post_contents.language_id')
            ->where('posts.id', '=', $id)
            ->where(function ($q) use ($args) {
                if ($args['global_status'] != null) {
                    $q->where('posts.status', '=', $args['global_status']);
                }

                if ($args['status'] != null) {
                    $q->where('post_contents.status', '=', $args['status']);
                }

            })
            ->where('post_contents.language_id', '=', $languageId)
            ->select($select)
            ->first();
    }

    public static function getBySlug($slug, $languageId, $options = [], $select = [])
    {
        $options = (array) $options;
        $defaultArgs = [
            'status' => 1,
            'global_status' => 1,
        ];
        $args = array_merge($defaultArgs, $options);

        $select = (array) $select;
        if (!$select) {
            $select = [
                'posts.status as global_status',
                'posts.page_template',
                'posts.global_title',
                'post_contents.*',
                'posts.id',
                'post_contents.id as content_id',
                'languages.language_code',
                'languages.language_name',
                'languages.default_locale'
            ];
        }

        return static::join('post_contents', 'posts.id', '=', 'post_contents.post_id')
            ->join('languages', 'languages.id', '=', 'post_contents.language_id')
            ->where('post_contents.slug', '=', $slug)
            ->where(function ($q) use ($args) {
                if ($args['global_status'] != null) {
                    $q->where('posts.status', '=', $args['global_status']);
                }

                if ($args['status'] != null) {
                    $q->where('post_contents.status', '=', $args['status']);
                }

            })
            ->where('post_contents.language_id', '=', $languageId)
            ->select($select)
            ->first();
    }

    public static function getContentById($id, $languageId, $select = [])
    {
        return PostContent::getBy([
            'post_id' => $id,
            'language_id' => $languageId,
        ], null, false, 0, $select);
    }

    public static function getByCategory($id, $languageId, $otherFields = [], $order = null, $select = null, $perPage = 0)
    {
        $items = Post::join('post_contents', 'posts.id', '=', 'post_contents.post_id')
            ->join('languages', 'languages.id', '=', 'post_contents.language_id')
            ->join('categories_posts', 'categories_posts.post_id', '=', 'posts.id')
            ->join('categories', 'categories.id', '=', 'categories_posts.category_id')
            ->groupBy('posts.id')
            ->where([
                'categories.id' => $id,
                'post_contents.language_id' => $languageId,
            ]);
        foreach ($otherFields as $key => $row) {
            $items = $items->where(function ($q) use ($key, $row) {
                switch ($row['compare']) {
                    case 'LIKE':{
                            $q->where($key, $row['compare'], '%' . $row['value'] . '%');
                        }break;
                    case 'IN':{
                            $q->whereIn($key, (array) $row['value']);
                        }break;
                    case 'NOT_IN':{
                            $q->whereNotIn($key, (array) $row['value']);
                        }break;
                    default:{
                            $q->where($key, $row['compare'], $row['value']);
                        }break;
                }
            });
        }
        if ($order && is_array($order)) {
            foreach ($order as $key => $value) {
                $items = $items->orderBy($key, $value);
            }
        }
        if ($order == 'random') {
            $items = $items->orderBy(\DB::raw('RAND()'));
        }

        if ($select && sizeof($select) > 0) {
            $items = $items->select($select);
        }

        if ($perPage > 0) {
            return $items->paginate($perPage);
        }

        return $items->get();
    }

    public static function getNoContentByCategory($id, $otherFields = [], $order = null, $select = null, $perPage = 0)
    {
        $items = Post::join('categories_posts', 'categories_posts.post_id', '=', 'posts.id')
            ->join('categories', 'categories.id', '=', 'categories_posts.category_id')
            ->groupBy('posts.id')
            ->where([
                'categories.id' => $id,
            ]);
        foreach ($otherFields as $key => $row) {
            $items = $items->where(function ($q) use ($key, $row) {

                if ($row['compare'] == 'LIKE') {
                    $q->where($key, $row['compare'], '%' . $row['value'] . '%');
                } else {
                    $q->where($key, $row['compare'], $row['value']);
                }
            });
        }
        if ($order && is_array($order)) {
            foreach ($order as $key => $value) {
                $items = $items->orderBy($key, $value);
            }
        }
        if ($order == 'random') {
            $items = $items->orderBy(\DB::raw('RAND()'));
        }

        if ($select && sizeof($select) > 0) {
            $items = $items->select($select);
        }
        if ($perPage > 0) {
            return $items->paginate($perPage);
        }

        return $items->get();
    }
}