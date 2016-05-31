<?php

namespace App\Http\Controllers\Admin;

use App\Models;
use App\Models\Menu;
use App\Models\MenuContent;
use App\Models\MenuNode;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class MenuController extends BaseAdminController
{
    public $bodyClass = 'menu-controller', $routeLink = 'menus';

    public function __construct()
    {
        parent::__construct();

        $this->middleware('is_webmaster');

        $this->_setPageTitle('Menus', 'manage menus.');
        $this->_setBodyClass($this->bodyClass);

        $this->_loadAdminMenu($this->routeLink);
    }

    public function getIndex(Request $request)
    {
        $this->_setBodyClass($this->bodyClass . ' menus-list-page');
        return $this->_viewAdmin('menus.index');
    }

    /*Use for plugin Datatables*/
    public function postIndex(Request $request, Menu $object)
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
                    $orderBy = 'slug';
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

        $items = $object->searchBy($getByFields, [$orderBy => $orderType], true, $limit);

        $iTotalRecords = $items->count();
        $sEcho = intval($request->get('sEcho'));

        foreach ($items as $key => $row) {
            /*Edit link*/
            $link = asset($this->adminCpAccess . '/' . $this->routeLink . '/edit/' . $row->id . '/' . $this->defaultLanguageId);
            $removeLink = asset($this->adminCpAccess . '/' . $this->routeLink . '/delete/' . $row->id);

            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $row->id . '">',
                $row->id,
                $row->title,
                $row->slug,
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

    public function postFastEdit(Request $request)
    {
        $data = [
            'id' => $request->get('args_0', null),
            'title' => $request->get('args_1', null),
            'slug' => ($request->get('args_2', null)) ? str_slug($request->get('args_2', null)) : str_slug($request->get('args_1', null)),
        ];

        $object = new Menu();
        $messages = $object->fastEdit($data, false, true);
        return response()->json($messages);
    }

    public function deleteDelete(Request $request, Menu $menu, $id = 0)
    {
        $result = $menu->deleteMenu($id);
        return response()->json($result);
    }

    public function getEdit(Request $request, Menu $object, MenuContent $objectContent, MenuNode $objectNode, Models\Category $category, Models\ProductCategory $productCategory, $id, $language)
    {
        $dis = [];

        $oldInputs = old();
        if ($oldInputs && $id == 0) {
            $oldObject = new \stdClass();
            foreach ($oldInputs as $key => $row) {
                $oldObject->$key = $row;
            }
            $dis['object'] = $oldObject;
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
        $dis['currentEditLanguage'] = $currentEditLanguage;

        $dis['rawUrlChangeLanguage'] = asset($this->adminCpAccess . '/' . $this->routeLink . '/edit/' . $id) . '/';

        $menu = $object->find($id);
        if (!$menu) {
            $menu = new Menu();
            $menuContent = null;
        } else {
            $menuContent = $objectContent->findByFieldsOrCreate([
                'menu_id' => $menu->id,
                'language_id' => $language,
            ]);
        }

        $this->_setPageTitle('Menu', $menu->title);

        $dis['object'] = $menu;

        $dis['pages'] = Models\Page::getBy([
            'status' => 1,
        ], [
            'global_title' => 'ASC',
        ], true);

        $dis['categories'] = $this->_getCategoriesSelectSrc($category, 'category', 0);
        $dis['productCategories'] = $this->_getCategoriesSelectSrc($productCategory, 'product-category', 0);

        $dis['nestableMenuSrc'] = $this->_getNestableMenuSrc($menuContent, 0);

        return $this->_viewAdmin('menus.edit', $dis);
    }

    public function postEdit(Request $request, Menu $object, MenuContent $objectContent, MenuNode $objectNode, $id, $language)
    {
        $menu = $object->findOrNew($id);

        $data = $request->only(['title', 'slug']);
        $data['id'] = $menu->id;

        $data['slug'] = ($data['slug']) ? str_slug($data['slug']) : str_slug($data['title']);

        (!$id || $id == 0) ? $justUpdateSomeFields = true : $justUpdateSomeFields = false;

        $result = $menu->fastEdit($data, true, $justUpdateSomeFields);

        if ($result['error']) {
            $this->_setFlashMessage($result['message'], 'error');
            $this->_showFlashMessages();

            if ($id == 0) {
                return redirect()->back()->withInput();
            }

            return redirect()->back();
        }
        $this->_setFlashMessage($result['message'], 'success');

        if (!$id) {
            $menu = $result['object'];
        }

        $menuContent = $objectContent->getBy(['menu_id' => $menu->id, 'language_id' => $language]);
        if (!$menuContent) {
            $resultEditContent = $objectContent->fastEdit([
                'menu_id' => $menu->id,
                'language_id' => $language,
            ], true, true);
            if ($resultEditContent['error']) {
                $this->_setFlashMessage($resultEditContent['message'], 'error');
                $this->_showFlashMessages();
                return redirect()->back();
            }
            $menuContent = $resultEditContent['object'];
        }

        $menuNodesJson = json_decode($request->get('menu_nodes', null));

        /*Deleted nodes*/
        $deletedNodes = explode(' ', ltrim($request->get('deleted_nodes', '')));
        $objectNode->whereIn('id', $deletedNodes)->delete();
        $this->_recursiveSaveMenu($menuNodesJson, $menuContent->id, 0);

        $this->_showFlashMessages();

        if (!$id || $id == 0) {
            return redirect()->to(asset($this->adminCpAccess . '/' . $this->routeLink . '/edit/' . $menu->id . '/' . $language));
        }

        return redirect()->back();
    }

    private function _getMenuNodes($menu_content_id, $parent_id)
    {
        if (!$menu_content_id) {
            return [];
        }

        $menu_nodes = MenuNode::getBy([
            'menu_content_id' => $menu_content_id,
            'parent_id' => $parent_id,
        ], ['position' => 'ASC'], true);
        return $menu_nodes;
    }

    private function _getNestableMenuSrc($menu, $parent_id)
    {
        if (!$menu) {
            return '';
        }

        $menu_nodes = $this->_getMenuNodes($menu->id, $parent_id);
        $html_src = '';
        $html_src .= '<ol class="dd-list">';
        foreach ($menu_nodes as $key => $row):
            $data_title = $row->title;
            if (!$data_title || $data_title == '' || trim($data_title, '') == '') {
                switch ($row->type) {
                    case 'category':{
                            $category = $row->category;
                            if ($category) {
                                $data_title = $category->global_title;
                            }

                        }
                        break;
                    case 'product-category':{
                            $category = $row->productCategory;
                            if ($category) {
                                $data_title = $category->global_title;
                            }

                        }
                        break;
                    case 'page':{
                            $post = $row->page;
                            if ($post) {
                                $data_title = $post->global_title;
                            }

                        }
                        break;
                    default:{
                            $post = $row->page;
                            if ($post) {
                                $data_title = $post->global_title;
                            }

                        }
                        break;
                }
            }
            $data_title = htmlentities($data_title);

            $html_src .= '<li class="dd-item dd3-item ' . (($row->related_id > 0 && $row->related_id != '' && $row->related_id != null) ? 'post-item' : '') . '" data-type="' . $row->type . '" data-relatedid="' . $row->related_id . '" data-title="' . $row->title . '" data-class="' . $row->css_class . '" data-id="' . $row->id . '" data-customurl="' . $row->url . '" data-iconfont="' . $row->icon_font . '">';
            $html_src .= '<div class="dd-handle dd3-handle"></div>';
            $html_src .= '<div class="dd3-content">';
            $html_src .= '<span class="text pull-left" data-update="title">' . $data_title . '</span>';
            $type = $row->type;
            if ($type == null || $type == '' || trim($type, '') == '') {
                $type = $row->post->get()->post_type;
            }
            $html_src .= '<span class="text pull-right">' . $type . '</span>';
            $html_src .= '<a href="#" title="" class="show-item-details"><i class="fa fa-angle-down"></i></a>';
            $html_src .= '<div class="clearfix"></div>';
            $html_src .= '</div>';
            $html_src .= '<div class="item-details">';
            $html_src .= '<label class="pad-bot-5">';
            $html_src .= '<span class="text pad-top-5 dis-inline-block" data-update="title">Title</span>';
            $html_src .= '<input type="text" name="title" value="' . htmlentities($row->title) . '" data-old="' . htmlentities($row->title) . '" >';
            $html_src .= '</label>';
            if ($row->post_id > 0 && $row->post_id != '' && $row->post_id != null || $row->category_id > 0) {
            } else {
                $html_src .= '<label class="pad-bot-5 dis-inline-block">';
                $html_src .= '<span class="text pad-top-5" data-update="customurl">Url</span>';
                $html_src .= '<input type="text" name="customurl" value="' . $row->url . '" data-old="' . $row->url . '">';
                $html_src .= '</label>';
            }
            /*Icon font*/
            $html_src .= '<label class="pad-bot-5 dis-inline-block">';
            $html_src .= '<span class="text pad-top-5" data-update="iconfont">Icon - font</span>';
            $html_src .= '<input type="text" name="iconfont" value="' . $row->icon_font . '" data-old="' . $row->icon_font . '">';
            $html_src .= '</label>';
            /*Icon font*/

            $html_src .= '<label class="pad-bot-10">';
            $html_src .= '<span class="text pad-top-5 dis-inline-block">CSS class</span>';
            $html_src .= '<input type="text" name="class" value="' . $row->css_class . '" data-old="' . $row->css_class . '">';
            $html_src .= '</label>';
            $html_src .= '<div class="text-right">';
            $html_src .= '<a href="#" title="" class="btn red btn-remove btn-sm">Remove</a>';
            $html_src .= '<a href="#" title="" class="btn blue btn-cancel btn-sm">Cancel</a>';
            $html_src .= '</div>';
            $html_src .= '</div>';
            $html_src .= '<div class="clearfix"></div>';
            $html_src .= $this->_getNestableMenuSrc($menu, $row->id);
            $html_src .= '</li>';
        endforeach;
        $html_src .= '</ol>';
        return $html_src;
    }

    private function _saveMenuNode($json_item, $menu_content_id, $parent_id)
    {
        $data = [
            'id' => (isset($json_item->id)) ? $json_item->id : 0,
            'title' => (isset($json_item->title)) ? $json_item->title : '',
            'url' => (isset($json_item->customurl)) ? $json_item->customurl : '',
            'css_class' => (isset($json_item->class)) ? $json_item->class : '',
            'position' => (isset($json_item->position)) ? $json_item->position : '',
            'icon_font' => (isset($json_item->iconfont)) ? $json_item->iconfont : '',
            'type' => (isset($json_item->type)) ? $json_item->type : '',
            'menu_content_id' => $menu_content_id,
            'parent_id' => $parent_id,
        ];

        switch ($json_item->type) {
            case 'custom-link':{
                    $data['related_id'] = 0;
                }
                break;
            default:{
                    $data['related_id'] = $json_item->relatedid;
                }
                break;
        }

        $item = new MenuNode();
        $item = $item->fastEdit($data, true, true);

        if ($item['error']) {
            $this->_setFlashMessage('Some error occurred when update item - ' . $data['title'], 'error');
            return null;
        }
        return $item['object']->id;
    }

    private function _recursiveSaveMenu($json_arr, $menu_content_id, $parent_id)
    {
        foreach ((array) $json_arr as $key => $row) {
            $parent = $this->_saveMenuNode($row, $menu_content_id, $parent_id);
            if ($parent != null) {
                if (!empty($row->children)) {
                    $this->_recursiveSaveMenu($row->children, $menu_content_id, $parent);
                }
            }
        }
    }

    private function _getCategoriesSelectSrc($object, $type, $parentId = 0)
    {
        $postContent = $object::getBy([
            'status' => 1,
            'parent_id' => $parentId,
        ], [
            'global_title' => 'ASC',
        ], true);

        $html_src = '<ul class="list-item">';
        foreach ($postContent as $key => $row) {
            $html_src .= '<li>';
            $html_src .= '<a data-title="' . $row->global_title . '" data-relatedid="' . ($row->id) . '" data-type="' . $type . '" href="#">' . $row->global_title . '</a>';
            $html_src .= $this->_getCategoriesSelectSrc($object, $type, $row->id);
            $html_src .= '</li>';
        }
        $html_src .= '</ul>';
        if (sizeof($postContent) < 1) {
            return '';
        }

        return $html_src;
    }
}
