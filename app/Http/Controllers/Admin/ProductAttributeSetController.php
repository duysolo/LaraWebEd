<?php

namespace App\Http\Controllers\Admin;

use App\Models;
use App\Models\ProductAttributeSet;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ProductAttributeSetController extends BaseAdminController
{
    public $bodyClass = 'product-attribute-set-controller product-attribute-set-page', $routeLink = 'product-attribute-sets';

    public function __construct()
    {
        parent::__construct();

        $this->_setPageTitle('Attribute sets', 'manage all product attribute sets');
        $this->_setBodyClass($this->bodyClass);

        $this->_loadAdminMenu($this->routeLink);
    }

    public function getIndex(Request $request, ProductAttributeSet $object)
    {
        return $this->_viewAdmin('product-attribute-sets.index', $this->dis);
    }

    public function postIndex(Request $request, ProductAttributeSet $object)
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
            $customActionValue = $request->get('customActionValue', 0);
            switch ($customActionValue) {
                //
                default:{
                    $result = $object->updateMultiple($ids, [
                        'status' => $customActionValue,
                    ], true);
                }break;
            }
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
                $orderBy = 'title';
            }
                break;
            case 2:{
                $orderBy = 'slug';
            }
                break;
            case 3:{
                $orderBy = 'status';
            }
                break;
            case 4:{
                $orderBy = 'order';
            }
                break;
            default:{
                $orderBy = 'id';
            }
                break;
        }
        $orderType = $request->get('order')[0]['dir'];

        $getByFields = [];
        if ($request->get('title', null) != null) {
            $getByFields['title'] = ['compare' => 'LIKE', 'value' => $request->get('title')];
        }
        if ($request->get('slug', null) != null) {
            $getByFields['slug'] = ['compare' => 'LIKE', 'value' => $request->get('slug')];
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
            $popular = '';
            if ($row->is_popular != 0) {
                $popular = '<span class="label label-success label-sm">Popular</span>';
            }

            /*Edit link*/
            $link = asset($this->adminCpAccess . '/' . $this->routeLink . '/edit/' . $row->id);
            $removeLink = asset($this->adminCpAccess . '/' . $this->routeLink . '/delete/' . $row->id);

            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $row->id . '">',
                $row->title,
                $row->slug,
                $status,
                $row->order,
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

    public function postFastEdit(Request $request, ProductAttributeSet $object)
    {
        $data = [
            'id' => $request->get('args_0', null),
            'title' => $request->get('args_1', null),
            'slug' => str_slug($request->get('args_2', null)),
            'order' => $request->get('args_3', null),
        ];

        $result = $object->fastEdit($data, false, true);
        return response()->json($result, $result['response_code']);
    }

    public function deleteDelete(Request $request, ProductAttributeSet $object, $id)
    {
        $result = $object->deleteItem($id);
        return response()->json($result, $result['response_code']);
    }

    public function getEdit(Request $request, ProductAttributeSet $object, ProductAttribute $objectAttribute, $id)
    {
        $oldInputs = old();
        $checkedNodes = [];

        if ($oldInputs) {
            $oldObject = new \stdClass();
            foreach ($oldInputs as $key => $row) {
                $oldObject->$key = $row;
            }
            $this->dis['object'] = $oldObject;
        } else {
            if(!$id) {
                $this->dis['object'] = $object;
            } else {
                $attributeSet = $object->find($id);
                if(!$attributeSet) {
                    $this->_setFlashMessage('Item not exists.', 'error');
                    $this->_showFlashMessages();
                    return redirect()->back();
                }
                $this->dis['object'] = $attributeSet;
                $checkedNodes = $attributeSet->productCategory()->getRelatedIds()->toArray();
            }
        }

        $this->dis['categoriesHtml'] = $this->_getCategories(0, $checkedNodes);

        return $this->_viewAdmin('product-attribute-sets.edit', $this->dis);
    }

    public function postEdit(Request $request, ProductAttributeSet $object, $id)
    {
        $data = $request->all();
        if (!$data['slug']) {
            $data['slug'] = str_slug($data['title']);
        }

        $id = (int)$id;

        $data['id'] = $id;

        \DB::beginTransaction();

        if(!$id) {
            $result = $object->fastEdit($data, true, false);
        } else {
            $result = $object->fastEdit($data, false, true);
        }

        if ($result['error']) {
            \DB::rollBack();

            $this->_setFlashMessage($result['message'], 'error');
            $this->_showFlashMessages();

            if ($id == 0) {
                return redirect()->back()->withInput();
            }

            return redirect()->back();
        }

        $resultSyncCategory = true;
        if (isset($data['category_ids'])) {
            $resultSyncCategory = $result['object']->productCategory()->sync($data['category_ids']);
        }
        if(!$resultSyncCategory) {
            \DB::rollBack();

            $this->_setFlashMessage('Error when sync related categories', 'error');
            $this->_showFlashMessages();

            if ($id == 0) {
                return redirect()->back()->withInput();
            }

            return redirect()->back();
        }

        \DB::commit();

        $this->_setFlashMessage($result['message'], 'success');
        $this->_showFlashMessages();

        /*Save completed*/
        if ($id == 0) {
            return redirect()->to(asset($this->adminCpAccess . '/' . $this->routeLink . '/edit/' . $result['object']->id));
        }
        return redirect()->back();
    }

    public function postDetails(Request $request, ProductAttribute $object, $id)
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
            $customActionValue = $request->get('customActionValue', 0);
            switch ($customActionValue) {
                //
                default:{
                    $result = $object->updateMultiple($ids, [
                        'status' => $customActionValue,
                    ], true);
                }break;
            }
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
                $orderBy = 'name';
            }
                break;
            case 2:{
                $orderBy = 'slug';
            }
                break;
            case 3:{
                $orderBy = 'value';
            }
                break;
            case 4:{
                $orderBy = 'order';
            }
                break;
            default:{
                $orderBy = 'id';
            }
                break;
        }
        $orderType = $request->get('order')[0]['dir'];

        $getByFields = [
            'attribute_set_id' => [
                'compare' => '=',
                'value' => $id
            ]
        ];
        if ($request->get('name', null) != null) {
            $getByFields['name'] = ['compare' => 'LIKE', 'value' => $request->get('name')];
        }
        if ($request->get('slug', null) != null) {
            $getByFields['slug'] = ['compare' => 'LIKE', 'value' => $request->get('slug')];
        }
        if ($request->get('value', null) != null) {
            $getByFields['value'] = ['compare' => '=', 'value' => $request->get('value')];
        }

        $items = $object->searchBy($getByFields, [$orderBy => $orderType], true, $limit);

        $iTotalRecords = $items->total();
        $sEcho = intval($request->get('sEcho'));

        foreach ($items as $key => $row) {
            /*Edit link*/
            $link = asset($this->adminCpAccess . '/' . $this->routeLink . '/edit-attribute/' . $id . '/' . $row->id);
            $removeLink = asset($this->adminCpAccess . '/' . $this->routeLink . '/delete-attribute/' . $row->id);

            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $row->id . '">',
                $row->name,
                $row->slug,
                $row->value,
                $row->order,
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

    public function postFastEditAttribute(Request $request, ProductAttributeSet $objectSet, ProductAttribute $object, $attributeSetId)
    {
        $attributeSet = $objectSet->find($attributeSetId);
        if(!$attributeSet) {
            return response()->json([
                'error' => true,
                'response_code' => 500,
                'message' => 'Attribute set not found',
            ], 500);
        }

        $data = [
            'attribute_set_id' => $attributeSetId,
            'id' => $request->get('args_0', null),
            'name' => $request->get('args_1', null),
            'slug' => str_slug($request->get('args_2', null)),
            'value' => $request->get('args_3', null),
            'order' => $request->get('args_4', null),
        ];

        $result = $object->fastEdit($data, false, true);

        return response()->json($result, $result['response_code']);
    }

    public function deleteDeleteAttribute(Request $request, ProductAttribute $object, $id)
    {
        $result = $object->deleteItem($id);
        return response()->json($result, $result['response_code']);
    }

    public function getEditAttribute(Request $request, ProductAttributeSet $objectSet, ProductAttribute $object, $attributeSetId, $id)
    {
        $attributeSet = $objectSet->find($attributeSetId);
        if(!$attributeSet) {
            $this->_setFlashMessage('Related attribute set not exists.', 'error');
            $this->_showFlashMessages();
            return redirect()->back();
        }
        
        $this->dis['attributeSet'] = $attributeSet;

        $oldInputs = old();
        if ($oldInputs) {
            $oldObject = new \stdClass();
            foreach ($oldInputs as $key => $row) {
                $oldObject->$key = $row;
            }
            $this->dis['object'] = $oldObject;
        } else {
            if(!$id) {
                $this->dis['object'] = $object;
            } else {
                $attribute = $object->getBy([
                    'id' => $id,
                    'attribute_set_id' => $attributeSetId,
                ]);
                if(!$attribute) {
                    $this->_setFlashMessage('Item not exists.', 'error');
                    $this->_showFlashMessages();
                    return redirect()->back();
                }

                $this->dis['object'] = $attribute;
            }
        }

        return $this->_viewAdmin('product-attribute-sets.edit-attribute', $this->dis);
    }

    public function postEditAttribute(Request $request, ProductAttributeSet $objectSet, ProductAttribute $object, $attributeSetId, $id)
    {
        $attributeSet = $objectSet->find($attributeSetId);
        if(!$attributeSet) {
            $this->_setFlashMessage('Related attribute set not exists.', 'error');
            $this->_showFlashMessages();
            return redirect()->back();
        }

        $data = $request->all();
        if (!$data['slug']) {
            $data['slug'] = str_slug($data['name']);
        }

        $id = (int)$id;

        $data['attribute_set_id'] = $attributeSetId;
        $data['id'] = $id;

        \DB::beginTransaction();

        if(!$id) {
            $result = $object->fastEdit($data, true, false);
        } else {
            $result = $object->fastEdit($data, false, true);
        }

        if ($result['error']) {
            \DB::rollBack();

            $this->_setFlashMessage($result['message'], 'error');
            $this->_showFlashMessages();

            if ($id == 0) {
                return redirect()->back()->withInput();
            }

            return redirect()->back();
        }

        \DB::commit();

        $this->_setFlashMessage($result['message'], 'success');
        $this->_showFlashMessages();

        /*Save completed*/
        if($request->has('save_and_go_back')) {
            return redirect()->to(asset($this->adminCpAccess . '/' . $this->routeLink . '/edit/' . $attributeSetId));
        }

        if ($id == 0) {
            return redirect()->to(asset($this->adminCpAccess . '/' . $this->routeLink . '/edit-attribute/' . $attributeSetId . '/' . $result['object']->id));
        }

        return redirect()->back();
    }

    private function _getCategories($parent = 0, $checkedNodes = [])
    {
        $result = '';
        $nodes = Models\ProductCategory::getBy([
            'parent_id' => $parent,
        ], [
            'global_title' => 'ASC',
        ], true);
        if ($nodes->count() > 0) {
            $dis = [
                'nodes' => $nodes,
                'checkedNodes' => $checkedNodes
            ];
            $result = view('admin._partials._categories', $dis)->render();
        }
        return $result;
    }
}