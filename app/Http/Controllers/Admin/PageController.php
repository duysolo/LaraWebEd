<?php

namespace App\Http\Controllers\Admin;

use Acme;
use App\Http\Controllers\Admin\AdminFoundation\CustomFields;
use App\Models;
use App\Models\Page;
use App\Models\PageContent;
use App\Models\PageMeta;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class PageController extends BaseAdminController
{

    use CustomFields;

    public $bodyClass = 'page-controller', $routeLink = 'pages';
    public function __construct()
    {
        parent::__construct();

        $this->middleware('is_admin');

        $this->_setPageTitle('Pages', 'manage static pages');
        $this->_setBodyClass($this->bodyClass);

        $this->_loadAdminMenu($this->routeLink);
    }

    public function getIndex(Request $request, Page $object)
    {
        $this->_setBodyClass($this->bodyClass . ' pages-list-page');

        return $this->_viewAdmin('pages.index');
    }

    public function postIndex(Request $request, Page $object)
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
                    $orderBy = 'global_title';
                }
                break;
            case 3:
                {
                    $orderBy = 'page_template';
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
        if ($request->get('global_title', null) != null) {
            $getByFields['global_title'] = ['compare' => 'LIKE', 'value' => $request->get('global_title')];
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
            $link = asset($this->adminCpAccess . '/' . $this->routeLink . '/edit/' . $row->id . '/' . $this->defaultLanguageId);
            $removeLink = asset($this->adminCpAccess . '/' . $this->routeLink . '/delete/' . $row->id);

            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $row->id . '">',
                $row->id,
                $row->global_title,
                $row->page_template,
                $status,
                $row->order,
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

    public function postFastEdit(Request $request, Page $object)
    {
        $data = [
            'id' => $request->get('args_0', null),
            'global_title' => $request->get('args_1', null),
            'order' => $request->get('args_2', null),
        ];

        $result = $object->fastEdit($data, false, true);
        return response()->json($result, $result['response_code']);
    }

    public function getEdit(Request $request, Page $object, $id, $language)
    {
        $oldInputs = old();
        if ($oldInputs && $id == 0) {
            $oldObject = new \stdClass();
            foreach ($oldInputs as $key => $row) {
                $oldObject->$key = $row;
            }
            $this->dis['object'] = $oldObject;
        }

        $currentEditLanguage = Models\Language::getBy([
            'id' => $language,
            'status' => 1,
        ]);
        if (!$currentEditLanguage) {
            $this->_setFlashMessage('This language it not supported', 'error');
            $this->_showFlashMessages();
            return redirect()->back();
        }
        $this->dis['currentEditLanguage'] = $currentEditLanguage;

        $this->dis['rawUrlChangeLanguage'] = asset($this->adminCpAccess . '/' . $this->routeLink . '/edit/' . $id) . '/';

        if (!$id == 0) {
            $item = $object->find($id);
            /*No page with this id*/
            if (!$item) {
                $this->_setFlashMessage('Item not exists.', 'error');
                $this->_showFlashMessages();
                return redirect()->back();
            }

            $item = $object->getById($id, $language, [
                'status' => null,
                'global_status' => null,
            ]);
            /*Create new if not exists*/
            if (!$item) {
                $item = new PageContent();
                $item->language_id = $language;
                $item->created_by = $this->loggedInAdminUser->id;
                $item->page_id = $id;
                $item->save();
                $item = $object->getById($id, $language, [
                    'status' => null,
                    'global_status' => null,
                ]);
            }
            $this->dis['object'] = $item;
            $this->_setPageTitle('Edit page', $item->global_title);

            $args = array(
                'user_type' => $this->loggedInAdminUser->adminUserRole->id,
                'page_id' => $id,
                'page_template' => $item->page_template,
                'user' => $this->loggedInAdminUser->id,
                'model_name' => 'Page',
            );
            $customFieldBoxes = new Acme\CmsCustomField();
            $customFieldBoxes = $customFieldBoxes->getCustomFieldsBoxes($item->content_id, $args, 'page');
            $this->dis['customFieldBoxes'] = $customFieldBoxes;
        }

        return $this->_viewAdmin('pages.edit', $this->dis);
    }

    public function postEdit(Request $request, Page $object, PageMeta $objectMeta, $id, $language)
    {
        $data = $request->all();
        if (!$data['slug']) {
            $data['slug'] = str_slug($data['title']);
        }

        \DB::beginTransaction();

        if ($id == 0) {
            $data['created_by'] = $this->loggedInAdminUser->id;
            $result = $object->createItem($language, $data);
        } else {
            $result = $object->updateItemContent($id, $language, $data);
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

        /*Save custom fields*/
        $customFields = json_decode($request->get('custom_fields'));
        $this->_saveContentMeta($result['object']->id, $customFields, $objectMeta);

        if ($id == 0) {
            return redirect()->to(asset($this->adminCpAccess . '/' . $this->routeLink . '/edit/' . $result['object']->page_id . '/' . $language));
        }
        return redirect()->back();
    }

    public function deleteDelete(Request $request, Page $object, $id)
    {
        $result = $object->deleteItem($id);
        return response()->json($result, $result['response_code']);
    }
}
