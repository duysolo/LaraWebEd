<?php
namespace App\Models;

use App\Models;
use App\Models\Category;

use App\Models\AbstractModel;
use Illuminate\Support\Facades\Validator;

class Post extends AbstractModel
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
        'status' => 'integer|required',
        'created_by' => 'integer'
    ];

    protected $editableFields = [
        'global_title',
        'status',
        'order',
        'page_template',
        'created_by'
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

    public function updatePost($id, $data, $justUpdateSomeFields = false)
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

    public function updatePostContent($id, $languageId, $data)
    {
        $result = [
            'error' => true,
            'response_code' => 500,
            'message' => 'Some error occurred!'
        ];

        $post = static::find($id);
        if (!$post) {
            $result['message'] = 'The post you have tried to edit not found.';
            $result['response_code'] = 404;
            return $result;
        }

        if (isset($data['slug'])) $data['slug'] = str_slug($data['slug']);

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
        $postContent = static::getPostContentByPostId($id, $languageId);
        if (!$postContent) {
            $postContent = new PostContent();
            $postContent->language_id = $languageId;
            $postContent->post_id = $id;
            $postContent->save();
        }

        $data['id'] = $postContent->id;

        return $postContent->fastEdit($data, false, true);
    }

    public static function deletePost($id)
    {
        $result = [
            'error' => true,
            'response_code' => 500,
            'message' => 'Some error occurred!'
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
            $customFields = PostMeta::join('post_contents', 'post_contents.id', '=', 'post_metas.content_id')
                ->join('posts', 'posts.id', '=', 'post_contents.post_id')
                ->where('posts.id', '=', $id)
                ->delete();

            if ($temp->delete()) {
                $result['error'] = false;
                $result['response_code'] = 200;
                $result['message'] = ['Delete related content completed!'];
            }
        }

        $object->category()->sync([]);

        if ($object->delete()) {
            $result['error'] = false;
            $result['response_code'] = 200;
            $result['message'] = ['Delete post completed!'];
        }

        return $result;
    }

    public function createPost($language, $data)
    {
        $dataPost = ['status' => 1];
        if (isset($data['title'])) $dataPost['global_title'] = $data['title'];
        if (isset($data['created_by'])) $dataPost['created_by'] = $data['created_by'];
        if (isset($data['category_ids'])) $dataPost['category_ids'] = $data['category_ids'];
        if (!isset($data['status'])) $data['status'] = 1;
        if (!isset($data['language_id'])) $data['language_id'] = $language;

        $resultCreatePost = $this->updatePost(0, $dataPost);

        /*No error*/
        if (!$resultCreatePost['error']) {
            $post_id = $resultCreatePost['object']->id;
            $resultUpdatePostContent = $this->updatePostContent($post_id, $language, $data);
            if($resultUpdatePostContent['error']) {
                $this->deletePost($resultCreatePost['object']->id);
            }
            return $resultUpdatePostContent;
        }
        return $resultCreatePost;
    }

    public static function getWithContent($fields = [], $order = null, $multiple = false, $perPage = 0)
    {
        $fields = (array)$fields;

        $obj = static::join('post_contents', 'posts.id', '=', 'post_contents.page_id')
            ->join('languages', 'languages.id', '=', 'post_contents.language_id');
        if ($fields && is_array($fields)) {
            foreach ($fields as $key => $row) {
                $obj = $obj->where(function ($q) use ($key, $row) {

                    if ($row['compare'] == 'LIKE') {
                        $q->where($key, $row['compare'], '%' . $row['value'] . '%');
                    } else {
                        $q->where($key, $row['compare'], $row['value']);
                    }
                });
            }
        }
        if ($order && is_array($order)) {
            foreach ($order as $key => $value) {
                $obj = $obj->orderBy($key, $value);
            }
        }
        $obj = $obj->groupBy('posts.id')
            ->select('posts.status as global_status', 'posts.page_template', 'posts.global_title', 'post_contents.*', 'languages.language_code', 'languages.language_name', 'languages.default_locale');

        if ($multiple) {
            if ($perPage > 0) return $obj->paginate($perPage);
            return $obj->get();
        }
        return $obj->first();
    }

    public static function getPostById($id, $languageId, $options = [])
    {
        $options = (array)$options;
        $defaultArgs = [
            'status' => 1,
            'global_status' => 1
        ];
        $args = array_merge($defaultArgs, $options);

        return static::join('post_contents', 'posts.id', '=', 'post_contents.post_id')
            ->join('languages', 'languages.id', '=', 'post_contents.language_id')
            ->where('posts.id', '=', $id)
            ->where(function ($q) use ($args) {
                if ($args['global_status'] != null) $q->where('posts.status', '=', $args['global_status']);
                if ($args['status'] != null) $q->where('post_contents.status', '=', $args['status']);
            })
            ->where('post_contents.language_id', '=', $languageId)
            ->select('posts.global_title', 'posts.page_template', 'posts.status as global_status', 'post_contents.*', 'languages.language_code', 'languages.language_name', 'languages.default_locale')
            ->first();
    }

    public static function getPostBySlug($slug, $languageId, $options = [])
    {
        $options = (array)$options;
        $defaultArgs = [
            'status' => 1,
            'global_status' => 1
        ];
        $args = array_merge($defaultArgs, $options);

        return static::join('post_contents', 'posts.id', '=', 'post_contents.post_id')
            ->join('languages', 'languages.id', '=', 'post_contents.language_id')
            ->where('post_contents.slug', '=', $slug)
            ->where(function ($q) use ($args) {
                if ($args['global_status'] != null) $q->where('posts.status', '=', $args['global_status']);
                if ($args['status'] != null) $q->where('post_contents.status', '=', $args['status']);
            })
            ->where('post_contents.language_id', '=', $languageId)
            ->select('posts.global_title', 'posts.page_template', 'posts.status as global_status', 'post_contents.*', 'languages.language_code', 'languages.language_name', 'languages.default_locale')
            ->first();
    }

    public static function getPostContentByPostId($id, $languageId)
    {
        return PostContent::getBy([
            'post_id' => $id,
            'language_id' => $languageId
        ]);
    }

    public static function getPostsByCategory($id, $languageId, $otherFields = [], $order = null, $perPage = 0, $select = null)
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
        if ($select && sizeof($select) > 0) {
            $items = $items->select($select);
        }
        if ($perPage > 0) return $items->paginate($perPage);
        return $items->get();
    }

    public static function getPostsNoContentByCategory($id, $otherFields = [], $order = null, $perPage = 0, $select = null)
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
        if ($select && sizeof($select) > 0) {
            $items = $items->select($select);
        }
        if ($perPage > 0) return $items->paginate($perPage);
        return $items->get();
    }
}