<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class UserController extends BaseAdminController
{
    public $bodyClass = 'page-controller', $routeLink = 'users';

    public function __construct()
    {
        parent::__construct();

        $this->middleware('is_admin');

        $this->_setPageTitle('Users', 'manage users');
        $this->_setBodyClass($this->bodyClass);

        $this->_loadAdminMenu($this->routeLink);
    }

    public function getIndex(Request $request)
    {
        $this->_setBodyClass($this->bodyClass . ' users-list-page');
        return $this->_viewAdmin('users.index');
    }

    public function postIndex(Request $request, User $object)
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
        if ($request->get('customActionType', null) == 'group_action' && $this->loggedInAdminUserRole->slug == 'webmaster') {
            $records["customActionStatus"] = "danger";
            $records["customActionMessage"] = "Group action did not completed. Some error occurred.";
            $ids = (array) $request->get('id', []);

            /*Remove current logged in user*/
            foreach ($ids as $key => $row) {
                if ($row == $this->loggedInAdminUser->id) {
                    unset($ids[$key]);
                }

            }

            $result = $object->updateMultiple($ids, [
                'user_role_id' => $request->get('customActionValue', 3),
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
                    $orderBy = 'email';
                }
                break;
            case 3:{
                    $orderBy = 'first_name';
                }
                break;
            case 4:{
                    $orderBy = 'last_name';
                }
                break;
            case 5:{
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
        if ($request->get('email', null) != null) {
            $getByFields['email'] = ['compare' => '=', 'value' => $request->get('email')];
        }
        if ($request->get('first_name', null) != null) {
            $getByFields['first_name'] = ['compare' => 'LIKE', 'value' => $request->get('first_name')];
        }
        if ($request->get('last_name', null) != null) {
            $getByFields['last_name'] = ['compare' => 'LIKE', 'value' => $request->get('last_name')];
        }
        if ($request->get('status', null) != null) {
            $getByFields['status'] = ['compare' => '=', 'value' => $request->get('status')];
        }

        $items = $object->searchBy($getByFields, [$orderBy => $orderType], true, $limit, [
            '*',
            \DB::raw('CONCAT(first_name, " ", last_name) as full_name'),
        ]);

        $iTotalRecords = $items->count();
        $sEcho = intval($request->get('sEcho'));

        foreach ($items as $key => $row) {
            $status = '<span class="label label-success label-sm">Activated</span>';
            if ($row->status != 1) {
                $status = '<span class="label label-danger label-sm">Disabled</span>';
            }
            /*Edit link*/
            $link = '<a href="' . asset($this->adminCpAccess . '/' . $this->routeLink . '/edit/' . $row->id) . '" class="btn btn-outline green btn-sm"><i class="icon-pencil"></i></a>';

            $activeLink = '<button type="button" data-ajax="' . asset($this->adminCpAccess . '/' . $this->routeLink . '/active/' . $row->id) . '" data-method="POST" data-toggle="confirmation" class="btn btn-outline blue btn-sm ajax-link" title="Active this user"><i class="fa fa-check"></i></button>';
            $disableLink = '<button type="button" data-ajax="' . asset($this->adminCpAccess . '/' . $this->routeLink . '/disable/' . $row->id) . '" data-method="POST" data-toggle="confirmation" class="btn btn-outline red-sunglo btn-sm ajax-link" title="Disable this user"><i class="fa fa-times"></i></button>';

            if ($row->status == 1) {
                $activeLink = '';
            }

            if ($row->status != 1) {
                $disableLink = '';
            }

            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $row->id . '">',
                $row->id,
                $row->email,
                $row->first_name,
                $row->last_name,
                $status,
                $row->created_at->toDateTimeString(),
                $row->last_login_at,
                $activeLink .
                $disableLink .
                $link,
            );
        }

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        return response()->json($records);
    }

    public function postActive(Request $request, User $object, $id)
    {
        return $this->_ajaxChangeStatus($object, $id, 1);
    }

    public function postDisable(Request $request, User $object, $id)
    {
        return $this->_ajaxChangeStatus($object, $id, 0);
    }

    public function _ajaxChangeStatus(User $object, $id, $status = 0)
    {
        $data = [
            'id' => $id,
            'status' => $status,
        ];

        $result = $object->fastEdit($data, false, true);
        return response()->json($result, $result['response_code']);
    }

    public function getEdit(Request $request, User $object, $id = 0)
    {
        $dis = [];

        if ($id == 0) {
            $this->_setPageTitle('Create user');
            $object->id = $id;
            $dis['object'] = $object;
        } else {
            $item = $object->getBy([
                'id' => $id,
            ], null, false, 0, [
                '*',
                \DB::raw('CONCAT(first_name, " ", last_name) as full_name'),
            ]);
            /*No user found with this id*/
            if (!$item) {
                $this->_setFlashMessage('User not found', 'error');
                $this->_showFlashMessages();
                return redirect()->back();
            }

            $dis['object'] = $item;
            $this->_setPageTitle('Edit user', $item->first_name . ' ' . $item->last_name . ' - ' . $item->email);
        }

        return $this->_viewAdmin('users.edit', $dis);
    }

    public function postEdit(Request $request, User $object, $id = 0)
    {
        $data = $request->all();

        $data['id'] = (int) $id;

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        if ($id != 0) {
            unset($data['email']);
            $result = $object->fastEdit($data, false, true);
        } else {
            $result = $object->fastEdit($data, true, false);
        }

        if ($result['error']) {
            $this->_setFlashMessage($result['message'], 'error');
            $this->_showFlashMessages();

            return redirect()->back();
        }

        $this->_setFlashMessage($result['message'], 'success');
        $this->_showFlashMessages();

        if ($id == 0) {
            return redirect()->to(asset($this->adminCpAccess . '/' . $this->routeLink . '/edit/' . $result['object']->id));
        }
        return redirect()->back();
    }
}
