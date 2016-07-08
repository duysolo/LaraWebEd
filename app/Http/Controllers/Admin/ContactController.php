<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ContactController extends BaseAdminController
{
    public $bodyClass = 'contact-controller', $routeLink = 'contacts';
    public function __construct()
    {
        parent::__construct();

        $this->middleware('is_admin');

        $this->_setPageTitle('Contacts', 'manage all user contacts');
        $this->_setBodyClass($this->bodyClass);

        $this->_loadAdminMenu($this->routeLink);
    }

    public function getIndex(Request $request)
    {
        $this->_setBodyClass($this->bodyClass . ' contacts-list-page');
        return $this->_viewAdmin('contacts.index');
    }

    public function postIndex(Request $request, Contact $object)
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
            case 1:
                {
                    $orderBy = 'id';
                }
                break;
            case 2:
                {
                    $orderBy = 'subject';
                }
                break;
            case 3:
                {
                    $orderBy = 'name';
                }
                break;

            case 4:
                {
                    $orderBy = 'phone';
                }
                break;
            case 5:
                {
                    $orderBy = 'email';
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

        $iTotalRecords = $items->total();
        $sEcho = intval($request->get('sEcho'));

        foreach ($items as $key => $row) {
            $status = '<span class="label label-success label-sm">Viewed</span>';
            if ($row->status != 1) {
                $status = '<span class="label label-danger label-sm">New</span>';
            }
            /*Edit link*/
            $link = asset($this->adminCpAccess . '/' . $this->routeLink . '/edit/' . $row->id);
            $removeLink = asset($this->adminCpAccess . '/' . $this->routeLink . '/delete/' . $row->id);

            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $row->id . '">',
                $row->id,
                $row->subject,
                $row->name,
                $row->phone,
                $row->email,
                substr($row->content, 0, 160) . '...',
                $status,
                $row->created_at->toDateTimeString(),
                '<a href="' . $link . '" class="btn btn-outline green btn-sm"><i class="icon-eye"></i></a>' .
                '<button type="button" data-ajax="' . $removeLink . '" data-method="DELETE" data-toggle="confirmation" class="btn btn-outline red-sunglo btn-sm ajax-link"><i class="fa fa-trash"></i></button>',
            );
        }

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        return response()->json($records);
    }

    public function postFastEdit(Request $request, Contact $object)
    {
        $data = [
            'id' => $request->get('args_0', null),
            'global_title' => $request->get('args_1', null),
        ];

        $result = $object->fastEdit($data, false, true);
        return response()->json($result, $result['response_code']);
    }

    public function getEdit(Request $request, Contact $object, $id)
    {
        $item = $object->find($id);
        /*No page with this id*/
        if (!$item) {
            $this->_setFlashMessage('Item not exists.', 'error');
            $this->_showFlashMessages();
            return redirect()->back();
        }

        /*Make this item as viewed*/
        $object->fastEdit([
            'id' => $item->id,
            'status' => 1,
        ], false, true);

        $this->dis['object'] = $item;
        $this->_setPageTitle('View contact #' . $item->id);

        return $this->_viewAdmin('contacts.edit', $this->dis);
    }

    public function deleteDelete(Request $request, Contact $object, $id)
    {
        $result = $object->deleteContact($id);
        return response()->json($result, $result['response_code']);
    }
}
