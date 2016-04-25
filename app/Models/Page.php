<?php
namespace App\Models;

use App\Models;

use App\Models\AbstractModel;
use Illuminate\Support\Facades\Validator;

class Page extends AbstractModel
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
    protected $table = 'pages';

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

    public function pageContent()
    {
        return $this->hasMany('App\Models\PageContent', 'page_id');
    }

    public function updatePage($id, $data, $justUpdateSomeFields = false)
    {
        $data['id'] = $id;
        return $this->fastEdit($data, true, $justUpdateSomeFields);
    }

    public function updatePageContent($id, $languageId, $data)
    {
        $result = [
            'error' => true,
            'response_code' => 500,
            'message' => 'Some error occurred!'
        ];

        $page = static::find($id);
        if (!$page) {
            $result['message'] = 'The page you have tried to edit not found.';
            $result['response_code'] = 404;
            return $result;
        }

        if (isset($data['slug'])) $data['slug'] = str_slug($data['slug']);

        /*Update page template*/
        if (isset($data['page_template'])) {
            $page->page_template = $data['page_template'];
            $page->save();
        }

        /*Update page content*/
        $pageContent = static::getPageContentByPageId($id, $languageId);
        if (!$pageContent) {
            $pageContent = new PageContent();
            $pageContent->language_id = $languageId;
            $pageContent->page_id = $id;
            $pageContent->save();
        }

        $data['id'] = $pageContent->id;

        return $pageContent->fastEdit($data, false, true);
    }

    public static function deletePage($id)
    {
        $result = [
            'error' => true,
            'response_code' => 500,
            'message' => 'Some error occurred!'
        ];
        $object = static::find($id);

        if (!$object) {
            $result['message'] = 'The page you have tried to edit not found';
            return $result;
        }

        $temp = PageContent::where('page_id', '=', $id);
        $related = $temp->get();
        if (!count($related)) {
            $related = null;
        }

        /*Remove all related content*/
        if ($related != null) {
            $customFields = PageMeta::join('page_contents', 'page_contents.id', '=', 'page_metas.content_id')
                ->join('pages', 'pages.id', '=', 'page_contents.page_id')
                ->where('pages.id', '=', $id)
                ->delete();

            if ($temp->delete()) {
                $result['error'] = false;
                $result['response_code'] = 200;
                $result['message'] = ['Delete related content completed!'];
            }
        }
        if ($object->delete()) {
            $result['error'] = false;
            $result['response_code'] = 200;
            $result['message'] = ['Delete page completed!'];
        }

        return $result;
    }

    public function createPage($language, $data)
    {
        $dataPage = ['status' => 1];
        if (isset($data['title'])) $dataPage['global_title'] = $data['title'];
        if (isset($data['page_template'])) $dataPage['page_template'] = $data['page_template'];
        if (!isset($data['status'])) $data['status'] = 1;
        if (!isset($data['language_id'])) $data['language_id'] = $language;

        $resultCreatePage = $this->updatePage(0, $dataPage);

        /*No error*/
        if (!$resultCreatePage['error']) {
            $page_id = $resultCreatePage['object']->id;
            $resultUpdatePageContent = $this->updatePageContent($page_id, $language, $data);
            return $resultUpdatePageContent;
        }
        return $resultCreatePage;
    }

    public static function getWithContent($fields = [], $order = null, $multiple = false, $perPage = 0)
    {
        $fields = (array)$fields;

        $obj = static::join('page_contents', 'pages.id', '=', 'page_contents.page_id')
            ->join('languages', 'languages.id', '=', 'page_contents.language_id');
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
        $obj = $obj->groupBy('pages.id')
            ->select('pages.status as global_status', 'pages.page_template', 'pages.global_title', 'page_contents.*', 'languages.language_code', 'languages.language_name', 'languages.default_locale');

        if ($multiple) {
            if ($perPage > 0) return $obj->paginate($perPage);
            return $obj->get();
        }
        return $obj->first();
    }

    public static function getPageById($id, $languageId = 0, $options = [])
    {
        $options = (array)$options;
        $defaultArgs = [
            'status' => 1,
            'global_status' => 1
        ];
        $args = array_merge($defaultArgs, $options);

        return static::join('page_contents', 'pages.id', '=', 'page_contents.page_id')
            ->join('languages', 'languages.id', '=', 'page_contents.language_id')
            ->where('pages.id', '=', $id)
            ->where(function ($q) use ($args) {
                if ($args['global_status'] != null) $q->where('pages.status', '=', $args['global_status']);
                if ($args['status'] != null) $q->where('page_contents.status', '=', $args['status']);
            })
            ->where('page_contents.language_id', '=', $languageId)
            ->select('pages.global_title', 'pages.status as global_status', 'pages.page_template', 'page_contents.*', 'languages.language_code', 'languages.language_name', 'languages.default_locale')
            ->first();
    }

    public static function getPageBySlug($slug, $languageId = 0, $options = [])
    {
        $options = (array)$options;
        $defaultArgs = [
            'status' => 1,
            'global_status' => 1
        ];
        $args = array_merge($defaultArgs, $options);

        return static::join('page_contents', 'pages.id', '=', 'page_contents.page_id')
            ->join('languages', 'languages.id', '=', 'page_contents.language_id')
            ->where('page_contents.slug', '=', $slug)
            ->where(function ($q) use ($args) {
                if ($args['global_status'] != null) $q->where('pages.status', '=', $args['global_status']);
                if ($args['status'] != null) $q->where('page_contents.status', '=', $args['status']);
            })
            ->where('page_contents.language_id', '=', $languageId)
            ->select('pages.global_title', 'pages.status as global_status', 'pages.page_template', 'page_contents.*', 'languages.language_code', 'languages.language_name', 'languages.default_locale')
            ->first();
    }

    public static function getPageContentByPageId($id, $languageId = 0)
    {
        return Models\PageContent::getBy([
            'page_id' => $id,
            'language_id' => $languageId
        ]);
    }
}