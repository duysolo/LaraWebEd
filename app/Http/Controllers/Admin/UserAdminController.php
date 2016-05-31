<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminUser;
use App\Models\AdminUserRole;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class UserAdminController extends BaseAdminController
{

    public $bodyClass = 'page-controller', $routeLink = 'admin-users';

    public function __construct()
    {
        parent::__construct();

        $this->middleware('is_admin', ['except' => ['getEdit', 'postEdit']]);

        $this->_setPageTitle('Admin users', 'manage admin users');
        $this->_setBodyClass($this->bodyClass);

        $this->_loadAdminMenu($this->routeLink);
    }

    public function getIndex(Request $request)
    {
        $this->_setBodyClass($this->bodyClass . ' admin-users-list-page');
        return $this->_viewAdmin('admin-users.index');
    }

    public function postIndex(Request $request, AdminUser $object)
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
                    $orderBy = 'username';
                }
                break;
            case 3:{
                    $orderBy = 'status';
                }
                break;
            case 4:{
                    $orderBy = 'user_role_id';
                }
                break;
            default:{
                    $orderBy = 'created_at';
                }
                break;
        }
        $orderType = $request->get('order')[0]['dir'];

        $getByFields = [];
        if ($request->get('username', null) != null) {
            $getByFields['username'] = ['compare' => 'LIKE', 'value' => $request->get('username')];
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
            $link = '<a href="' . asset($this->adminCpAccess . '/' . $this->routeLink . '/edit/' . $row->id) . '" class="btn btn-outline green btn-sm"><i class="icon-pencil"></i></a>';

            $activeLink = '<button type="button" data-ajax="' . asset($this->adminCpAccess . '/' . $this->routeLink . '/active/' . $row->id) . '" data-method="POST" data-toggle="confirmation" class="btn btn-outline blue btn-sm ajax-link" title="Active this user"><i class="fa fa-check"></i></button>';
            $disableLink = '<button type="button" data-ajax="' . asset($this->adminCpAccess . '/' . $this->routeLink . '/disable/' . $row->id) . '" data-method="POST" data-toggle="confirmation" class="btn btn-outline red-sunglo btn-sm ajax-link" title="Disable this user"><i class="fa fa-times"></i></button>';

            if ($row->status == 1) {
                $activeLink = '';
            }

            if ($row->status != 1) {
                $disableLink = '';
            }

            if (!$this->_hasPermissionToCreateOrUpdateUser($row->id)) {
                $link = '';
            }

            if ($this->loggedInAdminUserRole->slug != 'webmaster' || $row->id == $this->loggedInAdminUser->id) {
                $activeLink = '';
                $disableLink = '';
            }
            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $row->id . '">',
                $row->id,
                $row->username,
                $status,
                ($row->adminUserRole) ? $row->adminUserRole->name : '',
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

    public function postActive(Request $request, AdminUser $object, $id)
    {
        return $this->_ajaxChangeStatus($object, $id, 1);
    }

    public function postDisable(Request $request, AdminUser $object, $id)
    {
        return $this->_ajaxChangeStatus($object, $id, 0);
    }

    public function _ajaxChangeStatus(AdminUser $object, $id, $status = 0)
    {
        if ($this->loggedInAdminUserRole->slug != 'webmaster' || $id == $this->loggedInAdminUser->id) {
            return response()->json([
                'error' => true,
                'response_code' => 500,
                'message' => 'You do not have permission',
            ], 500);
        }

        $data = [
            'id' => $id,
            'status' => $status,
        ];

        $result = $object->fastEdit($data, false, true);
        return response()->json($result, $result['response_code']);
    }

    public function getEdit(Request $request, AdminUser $object, $id)
    {
        $dis = [
            'needToInputCurrentPassword' => false,
        ];

        if (!$this->_hasPermissionToCreateOrUpdateUser($id)) {
            $this->_setFlashMessage('You do not have permission', 'error');
            $this->_showFlashMessages();
            return redirect()->back();
        }

        if (!$id == 0) {
            $item = $object->find($id);
            /*No user found with this id*/
            if (!$item) {
                $this->_setFlashMessage('User not found', 'error');
                $this->_showFlashMessages();
                return redirect()->back();
            }

            $dis['object'] = $item;
            $this->_setPageTitle('Edit user', $item->username);

            $dis['needToInputCurrentPassword'] = $this->_needToInputCurrentPassword($item);
        }

        return $this->_viewAdmin('admin-users.edit', $dis);
    }

    private function _needToInputCurrentPassword(AdminUser $user)
    {
        if ($user->id == $this->loggedInAdminUser->id) {
            return true;
        }

        if ($this->loggedInAdminUserRole->slug == 'webmaster') {
            return false;
        }

        return true;
    }

    private function _hasPermissionToCreateOrUpdateUser($userId)
    {
        if ($this->loggedInAdminUser->id == $userId) {
            return true;
        }

        if ($this->_loggedIn_userHasRole('webmaster')) {
            return true;
        }

        if ($this->_loggedIn_userHasRole('administrator')) {
            $user = AdminUser::find($userId);
            /*Create user*/
            if (!$user) {
                return true;
            }

            /*Administrator can only create/update staff*/
            if ($this->_userHasRole($user, 'staff')) {
                return true;
            }

        }

        return false;
    }

    public function postEdit(Request $request, AdminUser $object, $id = 0)
    {
        if (!$this->_hasPermissionToCreateOrUpdateUser($id)) {
            $this->_setFlashMessage('You do not have permission', 'error');
            $this->_showFlashMessages();
            return redirect()->back();
        }

        $data = $request->all();

        $data['id'] = (int) $id;

        if ($id == 0) {
            $result = $object->createUser($data);
        } else {
            unset($data['username']);
            $object = $object->find($id);
            if (!$object) {
                $this->_setFlashMessage('User not found', 'error');
                $this->_showFlashMessages();
                return redirect()->back();
            }

            $result = $object->updateUser($data, true);
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
