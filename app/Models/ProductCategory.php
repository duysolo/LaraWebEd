<?php
namespace App\Models;

use App\Models;
use App\Models\AbstractModel;
use App\Models\Contracts;

class ProductCategory extends AbstractModel implements Contracts\MultiLanguageInterface
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
    protected $table = 'product_categories';

    protected $primaryKey = 'id';

    protected $rules = [
        'global_title' => 'required|max:255',
        'status' => 'integer|required|between:0,1',
    ];

    protected $editableFields = [
        'global_title',
        'status',
        'order',
        'parent_id',
        'created_by',
    ];

    public function categoryContent()
    {
        return $this->hasMany('App\Models\ProductCategoryContent', 'category_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'parent_id');
    }

    public function child()
    {
        return $this->hasMany('App\Models\ProductCategory', 'parent_id');
    }

    public function product()
    {
        return $this->belongsToMany('App\Models\Product', 'product_categories_products', 'category_id', 'product_id');
    }

    public function productAttributeSet()
    {
        return $this->belongsToMany('App\Models\ProductAttributeSet', 'product_attribute_sets_product_categories', 'category_id', 'attribute_set_id');
    }

    public function updateItem($id, $data, $justUpdateSomeFields = false)
    {
        $data['id'] = $id;
        return $this->fastEdit($data, true, $justUpdateSomeFields);
    }

    public function updateItemContent($id, $languageId, $data)
    {
        $result = [
            'error' => true,
            'response_code' => 500,
            'message' => 'Some error occurred!',
        ];

        $category = static::find($id);
        if (!$category) {
            $result['message'] = 'The page you have tried to edit not found.';
            $result['response_code'] = 404;
            return $result;
        }

        if (isset($data['slug'])) {
            $data['slug'] = str_slug($data['slug']);
        }

        /*Update page template*/
        if (isset($data['page_template'])) {
            $category->page_template = $data['page_template'];
        }
        /*Update parent_id*/
        if (isset($data['parent_id'])) {
            $category->parent_id = $data['parent_id'];
        }
        $category->save();

        /*Update category content*/
        $categoryContent = static::getContentById($id, $languageId);
        if (!$categoryContent) {
            $categoryContent = new ProductCategoryContent();
            $categoryContent->language_id = $languageId;
            $categoryContent->category_id = $id;
            $categoryContent->save();
        }

        $data['id'] = $categoryContent->id;

        return $categoryContent->fastEdit($data, false, true);
    }

    public static function deleteItem($id)
    {
        $result = [
            'error' => true,
            'response_code' => 500,
            'message' => 'Some error occurred!',
        ];
        $category = static::find($id);

        if (!$category) {
            $result['message'] = 'The category you have tried to edit not found';
            return $result;
        }

        \DB::beginTransaction();

        $temp = ProductCategoryContent::where('category_id', '=', $id);
        $related = $temp->get();
        if (!count($related)) {
            $related = null;
        }

        $deleteCategory = true;

        /*Remove all related content*/
        if ($related != null) {
            ProductCategoryMeta::join('product_category_contents', 'product_category_contents.id', '=', 'product_category_metas.content_id')
                ->join('product_categories', 'product_categories.id', '=', 'product_category_contents.category_id')
                ->where('product_categories.id', '=', $id)
                ->delete();
            $temp->delete();
        }
        $category->product()->sync([]);

        if($category->delete()) {
            /*Change all child item of this category to parent*/
            $relatedCategory = new static;
            $relatedCategory->updateMultipleGetByFields([
                'parent_id' => $id,
            ], [
                'parent_id' => 0,
            ], true);

            $result['error'] = false;
            $result['response_code'] = 200;
            $result['message'] = 'Delete category completed!';

            \DB::commit();
        } else {
            \DB::rollBack();
        }

        return $result;
    }

    public function createItem($language, $data)
    {
        $dataCategory = ['status' => 1];
        if (isset($data['title'])) {
            $dataCategory['global_title'] = $data['title'];
        }

        if (isset($data['parent_id'])) {
            $dataCategory['parent_id'] = $data['parent_id'];
        }

        if (!isset($data['status'])) {
            $data['status'] = 1;
        }

        if (!isset($data['language_id'])) {
            $data['language_id'] = $language;
        }

        $resultCreateItem = $this->updateItem(0, $dataCategory);

        /*No error*/
        if (!$resultCreateItem['error']) {
            $category_id = $resultCreateItem['object']->id;
            $resultUpdateItemContent = $this->updateItemContent($category_id, $language, $data);
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
                'product_categories.status as global_status',
                'product_categories.page_template',
                'product_categories.global_title',
                'product_categories.parent_id',
                'product_category_contents.*',
                'product_categories.id',
                'product_category_contents.id as content_id',
                'languages.language_code',
                'languages.language_name',
                'languages.default_locale'
            ];
        }

        $obj = static::join('product_category_contents', 'product_categories.id', '=', 'product_category_contents.category_id')
            ->join('languages', 'languages.id', '=', 'product_category_contents.language_id');
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

        $obj = $obj->groupBy('product_categories.id')
            ->select($select);

        if ($multiple) {
            if ($perPage > 0) {
                return $obj->paginate($perPage);
            }

            return $obj->get();
        }
        return $obj->first();
    }

    public static function getById($id, $languageId = 0, $options = [], $select = [])
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
                'product_categories.status as global_status',
                'product_categories.page_template',
                'product_categories.global_title',
                'product_categories.parent_id',
                'product_category_contents.*',
                'product_categories.id',
                'product_category_contents.id as content_id',
                'languages.language_code',
                'languages.language_name',
                'languages.default_locale'
            ];
        }

        return static::join('product_category_contents', 'product_categories.id', '=', 'product_category_contents.category_id')
            ->join('languages', 'languages.id', '=', 'product_category_contents.language_id')
            ->where('product_categories.id', '=', $id)
            ->where(function ($q) use ($args) {
                if ($args['global_status'] != null) {
                    $q->where('product_categories.status', '=', $args['global_status']);
                }

                if ($args['status'] != null) {
                    $q->where('product_category_contents.status', '=', $args['status']);
                }

            })
            ->where('product_category_contents.language_id', '=', $languageId)
            ->select($select)
            ->first();
    }

    public static function getBySlug($slug, $languageId = 0, $options = [], $select = [])
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
                'product_categories.status as global_status',
                'product_categories.page_template',
                'product_categories.global_title',
                'product_categories.parent_id',
                'product_category_contents.*',
                'product_categories.id',
                'product_category_contents.id as content_id',
                'languages.language_code',
                'languages.language_name',
                'languages.default_locale'
            ];
        }

        return static::join('product_category_contents', 'product_categories.id', '=', 'product_category_contents.category_id')
            ->join('languages', 'languages.id', '=', 'product_category_contents.language_id')
            ->where('product_category_contents.slug', '=', $slug)
            ->where(function ($q) use ($args) {
                if ($args['global_status'] != null) {
                    $q->where('product_categories.status', '=', $args['global_status']);
                }

                if ($args['status'] != null) {
                    $q->where('product_category_contents.status', '=', $args['status']);
                }

            })
            ->where('product_category_contents.language_id', '=', $languageId)
            ->select($select)
            ->first();
    }

    public static function getContentById($id, $languageId = 0, $select = [])
    {
        return Models\ProductCategoryContent::getBy([
            'category_id' => $id,
            'language_id' => $languageId,
        ], null, false, 0, $select);
    }
}
