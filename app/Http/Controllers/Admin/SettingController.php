<?php

namespace App\Http\Controllers\Admin;

use App\Models;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class SettingController extends BaseAdminController
{
    public $bodyClass = 'setting-controller', $routeLink = 'settings';
    public function __construct()
    {
        parent::__construct();

        $this->middleware('is_webmaster');

        $this->_setPageTitle('Settings', 'manage website settings');
        $this->_setBodyClass($this->bodyClass);

        $this->_loadAdminMenu($this->routeLink);
    }

    public function getIndex(Request $request)
    {
        $dis['settings'] = Models\Setting::getAllSettings();

        $dis['pages'] = Models\Page::getBy([
            'status' => 1,
        ], ['global_title' => 'ASC'], true);

        return $this->_viewAdmin('settings.index', $dis);
    }

    public function postIndex(Request $request)
    {
        $data = $request->except([
            '_token',
        ]);
        $data['construction_mode'] = ($request->has('construction_mode')) ? 1 : 0;
        $data['show_admin_bar'] = ($request->has('show_admin_bar')) ? 1 : 0;
        $result = Models\Setting::updateSettings($data);
        if ($result['error']) {
            $this->_setFlashMessage($result['message'], 'error');
            $this->_setFlashMessage(implode(', ', $result['errors']), 'error');
        } else {
            $this->_setFlashMessage($result['message'], 'success');
        }
        $this->_showFlashMessages();

        return redirect()->back();
    }

    public function getLanguages(Request $request)
    {
        $this->_setPageTitle('Languages', 'manage website languages');
        $this->_setBodyClass($this->bodyClass . ' languages-setting-page');

        $this->_loadAdminMenu($this->routeLink . '/languages');

        return $this->_viewAdmin('settings.languages');
    }

    public function postLanguages(Request $request, Models\Language $object)
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
            case 1:
                {
                    $orderBy = 'id';
                }
                break;
            case 2:
                {
                    $orderBy = 'language_name';
                }
                break;
            case 3:
                {
                    $orderBy = 'language_code';
                }
                break;
            case 4:
                {
                    $orderBy = 'default_locale';
                }
                break;
            case 5:
                {
                    $orderBy = 'currency';
                }
                break;
            case 6:
                {
                    $orderBy = 'status';
                }
                break;
            default:
                {
                    $orderBy = 'id';
                }
                break;
        }
        $orderType = $request->get('order')[0]['dir'];

        $getByFields = [];
        if ($request->get('language_name', null) != null) {
            $getByFields['language_name'] = ['compare' => 'LIKE', 'value' => $request->get('language_name')];
        }
        if ($request->get('language_code', null) != null) {
            $getByFields['language_code'] = ['compare' => '=', 'value' => $request->get('language_code')];
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

            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $row->id . '">',
                $row->id,
                $row->language_name,
                $row->language_code,
                $row->default_locale,
                $row->currency,
                $status,
                '<a class="fast-edit" title="Fast edit">Fast edit</a>',
            );
        }

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        return response()->json($records);
    }

    public function postFastEditLanguages(Request $request, Models\Language $object)
    {
        $data = [
            'id' => $request->get('args_0', null),
            'language_name' => $request->get('args_1', null),
            'language_code' => $request->get('args_2', null),
            'default_locale' => $request->get('args_3', null),
            'currency' => $request->get('args_4', null),
        ];

        $result = $object->fastEdit($data, false, true);
        return response()->json($result, $result['response_code']);
    }
}
