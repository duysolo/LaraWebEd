<?php

namespace App\Http\Controllers\Admin;

use Acme;
use App\Models\AdminUser;
use App\Models\AdminUserRole;
use App\Models\Category;
use App\Models\FieldGroup;
use App\Models\FieldItem;
use App\Models\Page;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class CustomFieldController extends BaseAdminController
{
    public $bodyClass = 'custom-field-controller';

    public function __construct()
    {
        parent::__construct();

        $this->middleware('is_webmaster');

        $this->_setPageTitle('Custom fields', 'manage custom fields.');
        $this->_setBodyClass($this->bodyClass);

        $this->_loadAdminMenu('custom-fields');
    }

    public function getIndex(Request $request)
    {
        $this->_setBodyClass($this->bodyClass . ' custom-fields-list-page');
        return $this->_viewAdmin('custom-fields.index');
    }

    public function postIndex(Request $request, FieldGroup $object)
    {
        /**
         * Paging
         **/
        $offset = $request->get('start', 0);
        $limit = $request->get('length', 10);
        $paged = ($offset + $limit) / $limit;
        Paginator::currentPageResolver(function () use ($paged) {
            return $paged;
        });

        $records = [];
        $records["data"] = [];

        /*Group actions*/
        if ($request->get('customActionType', null) == 'group_action') {
            \DB::beginTransaction();

            $records["customActionStatus"] = "danger";
            $records["customActionMessage"] = "Group action did not completed. Some error occurred.";
            $ids = (array) $request->get('id', []);
            $result = $object->updateMultiple($ids, [
                'status' => $request->get('customActionValue', 0),
            ], true);
            if (!$result['error']) {
                $records["customActionStatus"] = "success";
                $records["customActionMessage"] = "Group action has been completed.";
                \DB::commit();
            } else {
                \DB::rollBack();
            }
        }

        /*
         * Sortable data
         */
        $orderBy = $request->get('order')[0]['column'];
        switch ($orderBy) {
            case 1:{
                    $orderBy = 'id';
                }
                break;
            case 2:{
                    $orderBy = 'title';
                }
                break;
            case 3:{
                    $orderBy = 'status';
                }
                break;
            default:{
                    $orderBy = 'created_at';
                }
                break;
        }
        $orderType = $request->get('order')[0]['dir'];

        $getByFields = [];
        if ($request->get('title', null) != null) {
            $getByFields['title'] = ['compare' => 'LIKE', 'value' => $request->get('title')];
        }
        if ($request->get('status', null) != null) {
            $getByFields['status'] = ['compare' => '=', 'value' => $request->get('status')];
        }

        $items = $object->searchBy($getByFields, [$orderBy => $orderType], true, $limit);

        $iTotalRecords = $items->total();
        $sEcho = intval($request->get('sEcho'));

        foreach ($items as $key => $row) {
            $status = '<span class="label label-success label-sm">Activated</span>';
            if ($row->status != 1) {
                $status = '<span class="label label-danger label-sm">Disabled</span>';
            }
            /*Edit link*/
            $link = asset($this->adminCpAccess . '/custom-fields/edit/' . $row->id);
            $removeLink = asset($this->adminCpAccess . '/custom-fields/delete/' . $row->id);

            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $row->id . '">',
                $row->id,
                $row->title,
                $status,
                $row->created_at->toDateTimeString(),
                '<a class="fast-edit" title="Fast edit">Fast edit</a>',
                '<a href="' . $link . '" class="btn btn-outline green btn-sm"><i class="icon-pencil"></i></a>' .
                '<button type="button" data-ajax="' . $removeLink . '" data-method="DELETE" data-toggle="confirmation" class="btn btn-outline red-sunglo btn-sm ajax-link"><i class="fa fa-trash"></i></button>',
            );
        }

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        return response()->json($records);
    }

    public function postFastEdit(Request $request, FieldGroup $object)
    {
        $data = [
            'id' => $request->get('args_0', null),
            'title' => $request->get('args_1', null),
        ];

        $result = $object->fastEdit($data, false, true);
        return response()->json($result, $result['response_code']);
    }

    public function getEdit(Request $request, FieldGroup $object, $id = 0)
    {
        $this->dis['currentID'] = $id;

        if (!$id == 0 && !$id < 1) {
            $item = $object->find($id);
            /*No object with this id*/
            if (!$item) {
                $this->_setFlashMessage('Item not exists.', 'error');
                $this->_showFlashMessages();
                return redirect()->back();
            }
            $this->dis['object'] = $item;
            $this->_setPageTitle('Edit field group', $item->global_title);

            $this->dis['rulesHtml'] = $this->_initRulesHtml(json_decode($item->field_rules));

            $myCustomField = new Acme\CmsCustomField();
            $this->dis['sortableFieldHtml'] = $myCustomField->getFieldGroupItems($id);
        }
        return $this->_viewAdmin('custom-fields.edit', $this->dis);
    }

    public function postEdit(Request $request, FieldGroup $object, FieldItem $objectItem, $id = 0)
    {
        $data = [
            'id' => $id,
            'title' => $request->get('title', null),
            'field_rules' => $request->get('custom_fields_rules', null),
            'status' => 1,
        ];

        if ($id == 0) {
            $data['field_rules'] = json_encode([]);
            $result = $object->fastEdit($data, true, false);
        } else {
            $result = $object->fastEdit($data, false, true);
        }

        if ($result['error']) {
            $this->_setFlashMessage($result['message'], 'error');
            $this->_showFlashMessages();

            return redirect()->back();
        }

        $this->_setFlashMessage($result['message'], 'success');
        $this->_showFlashMessages();

        $deletedItems = json_decode($request->get('deleted_items'));
        if ($deletedItems) {
            $objectItem->whereIn('id', $deletedItems)
                ->orWhereIn('parent_id', $deletedItems)
                ->delete();
        }
        $items = json_decode($request->get('group_items'));
        $this->_editGroupItems($items, $result['object']->id);

        if ($id == 0) {
            return redirect()->to(asset($this->adminCpAccess . '/custom-fields/edit/' . $result['object']->id));
        }

        return redirect()->back();
    }

    public function deleteDelete(Request $request, FieldGroup $object, $id)
    {
        $result = $object->deleteFieldGroup($id);
        return response()->json($result, $result['response_code']);
    }

    private function _editGroupItems($items, $group_id, $parent = 0)
    {
        $position = 0;
        $items = (array) $items;
        foreach ($items as $key => $row) {
            $position++;
            $id = (int) $row->id;

            $item = FieldItem::findOrNew($id);
            $item->field_group_id = $group_id;
            $item->title = $row->title;
            $item->position = $position;
            $slug = str_slug($row->name, '_');
            if ($slug == '') {
                $slug = str_slug($row->title, '_');
            }
            // Check current slug has true format or not
            if ($this->_checkCurrentSlug($slug) != true) {
                $item->slug = 'temp_slug_!@#';
            }
            $item->field_type = $row->type;
            $item->options = json_encode($row->options);
            $item->instructions = $row->instructions;
            $item->parent_id = $parent;

            if ($item->save()) {
                if ($item->slug == 'temp_slug_!@#') {
                    $item->slug = $item->id . '_' . $slug;
                    $item->save();
                }
                $this->_editGroupItems($row->repeateritems, $group_id, $item->id);
            }
        }
    }

    private function _checkCurrentSlug($slug)
    {
        $exploded_slug = explode('_', $slug);
        if ((int) $exploded_slug[0] > 0) {
            return true;
        }
        return false;
    }

    private function _initRulesHtml($rules)
    {
        $options = [
            'pages' => $this->_getAllPages(),
            'page_templates' => _getPageTemplate('Page'),
            'post_templates' => _getPageTemplate('Post'),
            'product_templates' => _getPageTemplate('Product'),
            'category_templates' => _getPageTemplate('Category'),
            'product_category_templates' => _getPageTemplate('ProductCategory'),
            'users' => $this->_getAllUsers(),
            'roles' => $this->_getAllUserRoles(),
            'models' => [
                'Page',
                'Post',
                'Category',
                'Product',
                'ProductCategory',
            ],
        ];

        if (!$rules) {
            $rules = array();
        }

        $categories = Category::where('parent_id', '=', 0)->get();
        $productCategories = ProductCategory::where('parent_id', '=', 0)->get();

        return view('admin._partials.custom-fields._rules', ['options' => $options, 'rules' => $rules, 'categories' => $categories, 'productCategories' => $productCategories]);
    }

    private function _getAllUserRoles()
    {
        $result = [];

        $roles = AdminUserRole::select('id', 'name')->get();
        foreach ($roles as $key => $row) {
            $role = new \stdClass();
            $role->id = $row->id;
            $role->name = $row->name;

            array_push($result, $role);
        }

        return $result;
    }

    private function _getAllPages()
    {
        $result = [];

        $pages = Page::getBy([], [
            'global_title' => 'ASC',
        ], true);
        foreach ($pages as $key => $row) {
            $page = new \stdClass();
            $page->id = $row->id;
            $page->global_title = $row->global_title;

            array_push($result, $page);
        }
        return $result;
    }

    /*Get all users*/
    private function _getAllUsers()
    {
        $result = [];

        $users = AdminUser::getBy([
            'status' => 1,
        ], [
            'id' => 'ASC',
        ], true);
        foreach ($users as $key => $row) {
            $user = new \stdClass();
            $user->id = $row->id;
            $user->username = $row->username;

            array_push($result, $user);
        }
        return $result;
    }
}
