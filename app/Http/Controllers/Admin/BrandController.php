<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class BrandController extends BaseAdminController
{
    public $bodyClass = 'brand-controller', $routeLink = 'brands';

    public function __construct()
    {
        parent::__construct();

        $this->middleware('is_admin');

        $this->_setPageTitle('Brands', 'manage all product brands');
        $this->_setBodyClass($this->bodyClass);

        $this->_loadAdminMenu($this->routeLink);
    }

    public function getIndex(Request $request)
    {
        $this->_setBodyClass($this->bodyClass . ' brands-list-page');
        return $this->_viewAdmin('brands.index');
    }

    public function postIndex(Request $request, Brand $object)
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
            $records["customActionStatus"] = "danger";
            $records["customActionMessage"] = "Group action did not completed. Some error occurred.";
            $ids = (array) $request->get('id', []);
            $result = $object->updateMultiple($ids, [
                'status' => $request->get('customActionValue', 0),
            ], true);
            if (!$result['error']) {
                $records["customActionStatus"] = "success";
                $records["customActionMessage"] = "Group action has been completed.";
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
                    $orderBy = 'name';
                }
                break;
            default:{
                    $orderBy = 'created_at';
                }
                break;
        }
        $orderType = $request->get('order')[0]['dir'];

        $getByFields = [];
        if ($request->get('subject', null) != null) {
            $getByFields['subject'] = ['compare' => 'LIKE', 'value' => $request->get('subject')];
        }
        if ($request->get('name', null) != null) {
            $getByFields['name'] = ['compare' => 'LIKE', 'value' => $request->get('name')];
        }
        if ($request->get('phone', null) != null) {
            $getByFields['phone'] = ['compare' => 'LIKE', 'value' => $request->get('phone')];
        }
        if ($request->get('email', null) != null) {
            $getByFields['email'] = ['compare' => 'LIKE', 'value' => $request->get('email')];
        }
        if ($request->get('status', null) != null) {
            $getByFields['status'] = ['compare' => '=', 'value' => $request->get('status')];
        }

        $items = $object->searchBy($getByFields, [$orderBy => $orderType], true, $limit);

        $iTotalRecords = $items->count();
        $sEcho = intval($request->get('sEcho'));

        foreach ($items as $key => $row) {
            $status = '<span class="label label-success label-sm">Activated</span>';
            if ($row->status != 1) {
                $status = '<span class="label label-danger label-sm">Disabled</span>';
            }

            /*Edit link*/
            $link = asset($this->adminCpAccess . '/' . $this->routeLink . '/edit/' . $row->id);
            $removeLink = asset($this->adminCpAccess . '/' . $this->routeLink . '/delete/' . $row->id);

            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $row->id . '">',
                $row->id,
                $row->name,
                '<img src="' . $row->thumbnail . '" alt="' . $row->name . '" width="100" style="width: 100px;" class="middle-auto img-responsive">',
                $status,
                $row->created_at->toDateTimeString(),
                '<a href="' . $link . '" class="btn btn-outline green btn-sm"><i class="icon-pencil"></i></a>' .
                '<button type="button" data-ajax="' . $removeLink . '" data-method="DELETE" data-toggle="confirmation" class="btn btn-outline red-sunglo btn-sm ajax-link"><i class="fa fa-trash"></i></button>',
            );
        }

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        return response()->json($records);
    }

    public function postFastEdit(Request $request, Brand $object)
    {
        $data = [
            'id' => $request->get('args_0', null),
            'global_title' => $request->get('args_1', null),
        ];

        $result = $object->fastEdit($data, false, true);
        return response()->json($result, $result['response_code']);
    }

    public function getEdit(Request $request, Brand $object, $id = 0)
    {
        $dis = [];

        if ($id == 0) {
            $this->_setPageTitle('Create brand');
            $oldInputs = old();
            if ($oldInputs && $id == 0) {
                $oldObject = new \stdClass();
                foreach ($oldInputs as $key => $row) {
                    $oldObject->$key = $row;
                }
                $oldObject->id = $id;
                $dis['object'] = $oldObject;
            } else {
                $object->id = $id;
                $dis['object'] = $object;
            }
        } else {
            $item = $object->getBy([
                'id' => $id,
            ], null, false, 0, [
                '*',
            ]);
            /*No user found with this id*/
            if (!$item) {
                $this->_setFlashMessage('Brand not found', 'error');
                $this->_showFlashMessages();
                return redirect()->back();
            }

            $dis['object'] = $item;
            $this->_setPageTitle('Edit brand', $item->name);
        }

        return $this->_viewAdmin('brands.edit', $dis);
    }

    public function postEdit(Request $request, Brand $object, $id = 0)
    {
        $data = $request->all();

        if ($id == 0) {
            $result = $object->fastEdit($data, true);
        } else {
            $result = $object->fastEdit($data, false, true);
        }

        if ($result['error']) {
            $this->_setFlashMessage($result['message'], 'error');
            $this->_showFlashMessages();

            if ($id == 0) {
                return redirect()->back()->withInput();
            }

            return redirect()->back();
        }

        $this->_setFlashMessage($result['message'], 'success');
        $this->_showFlashMessages();

        if ($id == 0 && !$result['error']) {
            return redirect()->to(asset($this->adminCpAccess . '/' . $this->routeLink . '/edit/' . $result['object']->id));
        }
        return redirect()->back();
    }

    public function deleteDelete(Request $request, Brand $object, $id)
    {
        $result = $object->deleteItem($id);
        return response()->json($result, $result['response_code']);
    }
}
