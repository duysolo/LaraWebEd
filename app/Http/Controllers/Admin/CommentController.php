<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class CommentController extends BaseAdminController
{
    public $bodyClass = 'comment-controller', $routeLink = 'comments';

    public function __construct()
    {
        parent::__construct();

        $this->middleware('is_staff');

        $this->_setPageTitle('Comments', 'manage all user comments');
        $this->_setBodyClass($this->bodyClass);

        $this->_loadAdminMenu($this->routeLink);
    }

    public function getIndex(Request $request, Comment $object)
    {
        $this->_setBodyClass($this->bodyClass . ' comments-list-page');
        return $this->_viewAdmin('comments.index');
    }

    public function postIndex(Request $request, Comment $object)
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
            $ids = (array)$request->get('id', []);
            $customActionValue = $request->get('customActionValue', 0);
            switch ($customActionValue) {
                case 'deleted': {
                    $result = ['error' => !$object->whereIn('id', $ids)->delete()];
                    $object->whereIn('parent_id', $ids)->delete();
                }
                    break;
                default: {
                    $result = $object->updateMultiple($ids, [
                        'status' => $customActionValue,
                    ], true);
                }
                    break;
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
            case 1: {
                $orderBy = 'id';
            }
                break;
            case 2: {
                $orderBy = 'name';
            }
                break;
            case 3: {
                $orderBy = 'phone';
            }
                break;

            case 4: {
                $orderBy = 'email';
            }
                break;
            case 5: {
                $orderBy = 'comment_to';
            }
                break;
            default: {
                $orderBy = 'created_at';
            }
                break;
        }
        $orderType = $request->get('order')[0]['dir'];

        $getByFields = [];
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
            $status = '<span class="label label-success label-sm">Allowed</span>';
            if ($row->status != 1) {
                $status = '<span class="label label-danger label-sm">Pending</span>';
            }
            if ($row->parent_id) {
                $status = $status . '<br><span class="label label-info label-sm">comment reply</span>';
            }

            $commentTo = '<span class="label label-success label-sm">' . $row->comment_to . '</span>';
            $relatedObject = $row->getRelatedObject()
                ->select(['title', 'slug', 'language_id'])
                ->with('language')->first();
            if ($relatedObject) {
                $relatedLink = '';
                $relatedLanguageCode = $relatedObject->language;
                if ($relatedLanguageCode) {
                    app()->setLocale($relatedLanguageCode->default_locale);
                    $relatedLanguageCode = $relatedLanguageCode->language_code;
                }
                switch ($row->comment_to) {
                    case 'page': {
                        $relatedLink = _getPageLink($relatedObject->slug, $relatedLanguageCode);
                    }
                        break;
                    case 'post': {
                        $relatedLink = _getPostLink($relatedObject->slug, $relatedLanguageCode);
                    }
                        break;
                    case 'category': {
                        $relatedLink = _getCategoryLinkWithParentSlugs($relatedObject->content_id, $relatedLanguageCode);
                    }
                        break;
                    case 'product': {
                        $relatedLink = _getProductLink($relatedObject->slug, $relatedLanguageCode);
                    }
                        break;
                    case 'product-category': {
                        $relatedLink = _getProductCategoryLinkWithParentSlugs($relatedObject->content_id, $relatedLanguageCode);
                    }
                        break;
                }
                $commentTo .= ' - <a href="' . $relatedLink . '" title="' . $relatedObject->title . '" target="_blank">' . $relatedObject->title . '</a>';
            }

            /*Edit link*/
            $link = asset($this->adminCpAccess . '/' . $this->routeLink . '/edit/' . $row->id);
            $removeLink = asset($this->adminCpAccess . '/' . $this->routeLink . '/delete/' . $row->id);

            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $row->id . '">',
                $row->id,
                $row->name,
                $row->phone,
                $row->email,
                $commentTo,
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

    public function postFastEdit(Request $request, Comment $object)
    {
        $data = [
            'id' => $request->get('args_0', null),
            'global_title' => $request->get('args_1', null),
        ];

        $result = $object->fastEdit($data, false, true);
        return response()->json($result, $result['response_code']);
    }

    public function getEdit(Request $request, Comment $object, $id)
    {
        $item = $object->find($id);
        /*No page with this id*/
        if (!$item) {
            $this->_setFlashMessage('Item not exists.', 'error');
            $this->_showFlashMessages();
            return redirect()->back();
        }

        $this->dis['object'] = $item;
        $this->_setPageTitle('View comment #' . $item->id);

        return $this->_viewAdmin('comments.edit', $this->dis);
    }

    public function postEdit(Request $request, Comment $object, $id)
    {
        $data = $request->all();

        $item = $object->find($id);
        /*No comment with this id*/
        if (!$item) {
            $this->_setFlashMessage('Item not exists.', 'error');
            $this->_showFlashMessages();
            return redirect()->back();
        }
        $data['id'] = $id;

        $result = $object->fastEdit($data, false, true);

        if ($result['error']) {
            $this->_setFlashMessage($result['message'], 'error');
            $this->_showFlashMessages();
            return redirect()->back();
        }

        $this->_setFlashMessage($result['message'], 'success');
        $this->_showFlashMessages();

        return redirect()->back();
    }

    public function getReply(Request $request, Comment $object, $id)
    {
        $item = $object->find($id);
        /*No comment with this id*/
        if (!$item) {
            $this->_setFlashMessage('Item not exists.', 'error');
            $this->_showFlashMessages();
            return redirect()->back();
        }

        $object->parent_id = $item->id;

        $this->dis['object'] = $object;
        $this->_setPageTitle('Reply comment #' . $item->id);

        return $this->_viewAdmin('comments.edit', $this->dis);
    }

    public function postReply(Request $request, Comment $object, $id)
    {
        $data = $request->all();

        $item = $object->find($id);
        /*No comment with this id*/
        if (!$item) {
            $this->_setFlashMessage('Item not exists.', 'error');
            $this->_showFlashMessages();
            return redirect()->back();
        }

        $data['parent_id'] = (!$item->parent_id && $item->parent_id > 0) ? $item->id : $item->parent_id;
        $data['comment_to'] = $item->comment_to;
        $data['related_id'] = $item->related_id;

        $result = $object->fastEdit($data, true, true);

        if ($result['error']) {
            $this->_setFlashMessage($result['message'], 'error');
            $this->_showFlashMessages();
            return redirect()->back();
        }

        $this->_setFlashMessage($result['message'], 'success');
        $this->_showFlashMessages();

        return redirect()->to($this->adminCpAccess.'/comments/edit/'.$result['object']->id);
    }

    public function deleteDelete(Request $request, Comment $object, $id)
    {
        $result = $object->deleteComment($id);
        return response()->json($result, $result['response_code']);
    }
}
