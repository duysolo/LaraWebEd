<?php

namespace App\Http\Controllers\Admin;

use Acme;
use App\Models;
use App\Models\Coupon;
use App\Models\CouponContent;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class CouponController extends BaseAdminController
{
    var $bodyClass = 'coupon-controller', $routeLink = 'coupons';
    public function __construct()
    {
        parent::__construct();

        $this->middleware('is_admin');

        $this->_setPageTitle('Coupons', 'manage coupons/giftcards');
        $this->_setBodyClass($this->bodyClass);

        $this->_loadAdminMenu($this->routeLink);
    }

    public function getIndex(Request $request)
    {
        $this->_setBodyClass($this->bodyClass.' coupons-list-page');
        return $this->_viewAdmin('coupons.index');
    }

    public function postIndex(Request $request, Coupon $object)
    {
        /**
         * Paging
         **/
        $offset = $request->get('start', 0);
        $limit = $request->get('length', 10);
        $paged = ($offset + $limit) / $limit;
        Paginator::currentPageResolver(function() use ($paged) {
            return $paged;
        });

        $records = [];
        $records["data"] = [];


        /*Group actions*/
        if($request->get('customActionType', null) == 'group_action')
        {
            $records["customActionStatus"] = "danger";
            $records["customActionMessage"] = "Group action did not completed. Some error occurred.";
            $ids = (array)$request->get('id', []);
            $result = $object->updateMultiple($ids, [
                'status' => $request->get('customActionValue', 0)
            ], true);
            if(!$result['error'])
            {
                $records["customActionStatus"] = "success";
                $records["customActionMessage"] = "Group action has been completed.";
            }
        }

        /*
        * Sortable data
        */
        $orderBy = $request->get('order')[0]['column'];
        switch ($orderBy) {
            case 1:
            {
                $orderBy = 'id';
            }
                break;
            case 2:
            {
                $orderBy = 'global_title';
            }
                break;
            case 3:
            {
                $orderBy = 'coupon_code';
            }
                break;
            case 4:
            {
                $orderBy = 'status';
            }
                break;
            case 5:
            {
                $orderBy = 'order';
            }
                break;
            default:
            {
                $orderBy = 'created_at';
            }
                break;
        }
        $orderType = $request->get('order')[0]['dir'];

        $getByFields = [];
        if($request->get('global_title', null) != null)
        {
            $getByFields['global_title'] = ['compare' => 'LIKE', 'value' => $request->get('global_title')];
        }
        if($request->get('coupon_code', null) != null)
        {
            $getByFields['coupon_code'] = ['compare' => '=', 'value' => $request->get('coupon_code')];
        }
        if($request->get('status', null) != null)
        {
            $getByFields['status'] = ['compare' => '=', 'value' => $request->get('status')];
        }

        $items = $object->searchBy($getByFields, [$orderBy => $orderType], true, $limit);

        $iTotalRecords = $items->count();
        $sEcho = intval($request->get('sEcho'));

        foreach ($items as $key => $row)
        {
            $status = '<span class="label label-success label-sm">Activated</span>';
            if($row->status != 1)
            {
                $status = '<span class="label label-danger label-sm">Disabled</span>';
            }
            /*Edit link*/
            $link = asset($this->adminCpAccess.'/'.$this->routeLink.'/edit/'.$row->id.'/'.$this->defaultLanguageId);
            $removeLink = asset($this->adminCpAccess.'/'.$this->routeLink.'/delete/'.$row->id);

            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="'.$row->id.'">',
                $row->id,
                $row->global_title,
                $row->coupon_code,
                $status,
                $row->order,
                $row->created_at->toDateTimeString(),
                '<a class="fast-edit" title="Fast edit">Fast edit</a>',
                '<a href="'.$link.'" class="btn btn-outline green btn-sm"><i class="icon-pencil"></i></a>'.
                '<button type="button" data-ajax="'.$removeLink.'" data-method="DELETE" data-toggle="confirmation" class="btn btn-outline red-sunglo btn-sm ajax-link"><i class="fa fa-trash"></i></button>'
            );
        }

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        return response()->json($records);
    }

    public function postFastEdit(Request $request, Coupon $object)
    {
        $data = [
            'id' => $request->get('args_0', null),
            'global_title' => $request->get('args_1', null),
            'order' => $request->get('args_2', null),
        ];

        $result = $object->fastEdit($data, false, true);
        return response()->json($result, $result['response_code']);
    }

    public function getEdit(Request $request, Coupon $object, $id, $language)
    {
        $dis = [];
        $currentEditLanguage = Models\Language::getBy([
            'id' => $language,
            'status' => 1
        ]);
        if(!$currentEditLanguage)
        {
            $this->_setFlashMessage('This language it not supported', 'error');
            $this->_showFlashMessages();
            return redirect()->back();
        }
        $dis['currentEditLanguage'] = $currentEditLanguage;

        $dis['rawUrlChangeLanguage'] = asset($this->adminCpAccess.'/'.$this->routeLink.'/edit/'.$id).'/';

        if(!$id == 0)
        {
            $item = $object->find($id);
            /*No page with this id*/
            if(!$item)
            {
                $this->_setFlashMessage('Item not exists.', 'error');
                $this->_showFlashMessages();
                return redirect()->back();
            }

            $item = $object->getById($id, $language, [
                'status' => null,
                'global_status' => null
            ]);

            /*Create new if not exists*/
            if(!$item)
            {
                $item = new CouponContent();
                $item->language_id = $language;
                $item->coupon_id = $id;
                $item->created_by = $this->loggedInAdminUser->id;
                $item->expired_at = date('Y-m-d H:i:s');
                $item->save();
                $item = $object->getById($id, $language, [
                    'status' => null,
                    'global_status' => null
                ]);
            }

            $dis['object'] = $item;

            $this->_setPageTitle('Edit coupon', $item->global_title);
        }

        return $this->_viewAdmin('coupons.edit', $dis);
    }

    public function postEdit(Request $request, Coupon $object, $id, $language)
    {
        $data = $request->all();

        if($id == 0)
        {
            $data['created_by'] = $this->loggedInAdminUser->id;
            $data['coupon_code'] = strtoupper(str_random(10));
            $result = $object->createItem($language, $data);
        }
        else
        {
            $result = $object->updateItemContent($id, $language, $data);
        }

        if($result['error'])
        {
            $this->_setFlashMessage($result['message'], 'error');
            $this->_showFlashMessages();

            return redirect()->back();
        }

        $this->_setFlashMessage($result['message'], 'success');
        $this->_showFlashMessages();

        if($id == 0)
        {
            return redirect()->to(asset($this->adminCpAccess.'/'.$this->routeLink.'/edit/'.$result['object']->coupon_id.'/'.$language));
        }
        return redirect()->back();
    }

    public function deleteDelete(Request $request, Coupon $object, $id)
    {
        $result = $object->deleteItem($id);
        return response()->json($result, $result['response_code']);
    }
}