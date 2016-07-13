<?php

namespace App\Http\Controllers\Admin;

use Acme;
use App\Http\Controllers\Admin\AdminFoundation\CustomFields;
use App\Models;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductContent;
use App\Models\ProductMeta;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ProductController extends BaseAdminController
{

    use CustomFields;

    public $bodyClass = 'product-controller', $routeLink = 'products';

    public function __construct()
    {
        parent::__construct();

        $this->_setPageTitle('Products', 'manage products');
        $this->_setBodyClass($this->bodyClass);

        $this->_loadAdminMenu($this->routeLink);
    }

    public function getIndex(Request $request, Product $object)
    {
        $this->_setBodyClass($this->bodyClass . ' products-list-page');
        return $this->_viewAdmin('products.index');
    }

    public function postIndex(Request $request, Product $object)
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
                case 'set_as_popular':{
                        $result = $object->updateMultiple($ids, [
                            'is_popular' => 1,
                        ], true);
                    }
                    break;
                case 'unset_as_popular':{
                        $result = $object->updateMultiple($ids, [
                            'is_popular' => 0,
                        ], true);
                    }
                    break;
                default:{
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
            case 1:{
                    $orderBy = 'id';
                }
                break;
            case 2:{
                    $orderBy = 'global_title';
                }
                break;
            case 3:{
                $orderBy = 'sku';
            }
                break;
            case 4:{
                    $orderBy = 'status';
                }
                break;
            case 5:{
                    $orderBy = 'order';
                }
                break;
            case 6:{
                    $orderBy = 'is_popular';
                }
                break;
            case 7:{
                    $orderBy = 'brand_id';
                }
                break;
            default:{
                    $orderBy = 'created_at';
                }
                break;
        }
        $orderType = $request->get('order')[0]['dir'];

        $getByFields = [];
        if ($request->get('global_title', null) != null) {
            $getByFields['global_title'] = ['compare' => 'LIKE', 'value' => $request->get('global_title')];
        }
        if ($request->get('sku', null) != null) {
            $getByFields['sku'] = ['compare' => 'LIKE', 'value' => $request->get('sku')];
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
            $link = asset($this->adminCpAccess . '/' . $this->routeLink . '/edit/' . $row->id . '/' . $this->defaultLanguageId);
            $removeLink = asset($this->adminCpAccess . '/' . $this->routeLink . '/delete/' . $row->id);

            $brand = '';
            if ($row->brand) {
                $brand = '<img src="' . $row->brand->thumbnail . '" alt="' . $row->brand->name . '" width="100" style="width: 100px;" class="middle-auto img-responsive">';
            }

            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $row->id . '">',
                $row->id,
                $row->global_title,
                $row->sku,
                $status,
                $row->order,
                $popular,
                $brand,
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

    public function postFastEdit(Request $request, Product $object)
    {
        $data = [
            'id' => $request->get('args_0', null),
            'global_title' => $request->get('args_1', null),
            'sku' => $request->get('args_2', null),
            'order' => $request->get('args_3', null),
        ];

        $result = $object->fastEdit($data, false, true);
        return response()->json($result, $result['response_code']);
    }

    public function getEdit(Request $request, Product $object, Models\ProductAttributeSet $objectSet, $id, $language)
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
        app()->setLocale($currentEditLanguage->default_locale);

        $this->dis['currentEditLanguage'] = $currentEditLanguage;

        $this->dis['rawUrlChangeLanguage'] = asset($this->adminCpAccess . '/' . $this->routeLink . '/edit/' . $id) . '/';

        $checkedNodes = [];

        $this->_setPageTitle('Create product');

        if (!$id == 0) {
            $item = $object->find($id);
            /*No page with this id*/
            if (!$item) {
                $this->_setFlashMessage('Item not exists.', 'error');
                $this->_showFlashMessages();
                return redirect()->back();
            }
            $checkedNodes = $item->category()->getRelatedIds()->toArray();

            $item = $object->getById($id, $language, [
                'status' => null,
                'global_status' => null,
            ]);
            /*Create new if not exists*/
            if (!$item) {
                $item = new ProductContent();
                $item->language_id = $language;
                $item->created_by = $this->loggedInAdminUser->id;
                $item->product_id = $id;
                $item->save();
                $item = $object->getById($id, $language, [
                    'status' => null,
                    'global_status' => null,
                ]);
            }
            $this->dis['object'] = $item;
            $this->_setPageTitle('Edit product', $item->global_title);

            $args = array(
                'user_type' => $this->loggedInAdminUser->adminUserRole->id,
                'user' => $this->loggedInAdminUser->id,
                'post_template' => $item->page_template,
                'model_name' => 'Product',
                'product_with_related_product_category_id' => $checkedNodes,
            );
            $customFieldBoxes = new Acme\CmsCustomField();
            $customFieldBoxes = $customFieldBoxes->getCustomFieldsBoxes($item->content_id, $args, 'product');
            $this->dis['customFieldBoxes'] = $customFieldBoxes;

            $this->dis['attributeSet'] = $objectSet->join('product_attribute_sets_product_categories', 'product_attribute_sets.id', '=', 'product_attribute_sets_product_categories.attribute_set_id')
                ->whereIn('product_attribute_sets_product_categories.category_id', $checkedNodes)
                ->where('product_attribute_sets.status', '=', 1)
                ->select('product_attribute_sets.*')
                ->distinct()
                ->get();

            $this->dis['activatedAttributes'] = $item->productAttributeProduct()->get();
        }

        $this->dis['currentId'] = $id;

        $this->dis['categoriesHtml'] = $this->_getCategories(0, $checkedNodes);

        $this->dis['brands'] = Models\Brand::getBy([
            'status' => 1,
        ], [
            'name' => 'ASC',
        ], true, 0);

        return $this->_viewAdmin('products.edit', $this->dis);
    }

    public function postEdit(Request $request, Product $object, ProductMeta $objectMeta, $id, $language)
    {
        $data = $request->except(['tab', '_token']);
        //Update product attributes
        if(!$request->has('product_attributes')) {
            if ($request->has('is_out_of_stock')) {
                $data['is_out_of_stock'] = 1;
            } else {
                $data['is_out_of_stock'] = 0;
            }
            if (isset($data['slug'])) {
                if (!$data['slug']) {
                    $data['slug'] = str_slug($data['title']);
                }
            }
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

        /*Save completed*/
        $customFields = json_decode($request->get('custom_fields', '[]'));

        $this->_saveContentMeta($result['object']->id, $customFields, $objectMeta);

        if ($id == 0) {
            return redirect()->to(asset($this->adminCpAccess . '/' . $this->routeLink . '/edit/' . $result['object']->product_id . '/' . $language));
        }
        return redirect()->back();
    }

    public function deleteDelete(Request $request, Product $object, $id)
    {
        $result = $object->deleteItem($id);
        return response()->json($result, $result['response_code']);
    }

    private function _getCategories($parent = 0, $checkedNodes = [])
    {
        $result = '';
        $nodes = ProductCategory::getBy([
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
