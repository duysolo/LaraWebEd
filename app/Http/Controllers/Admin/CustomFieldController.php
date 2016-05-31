<?php

namespace App\Http\Controllers\Admin;

use Acme;
use App\Models\AdminUser;
use App\Models\AdminUserRole;
use App\Models\Category;
use App\Models\FieldGroup;
use App\Models\FieldItem;
use App\Models\Page;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class CustomFieldController extends BaseAdminController
{
    public $bodyClass = 'custom-field-controller';

    public function __construct()
    {
        parent::__construct();

        $this->middleware('is_webmaster');

        $this->_setPageTitle('Custom fields', 'manage custom fields.');
        $this->_setBodyClass($this->bodyClass);

        $this->_loadAdminMenu('custom-fields');
    }

    public function getIndex(Request $request)
    {
        $this->_setBodyClass($this->bodyClass . ' custom-fields-list-page');
        return $this->_viewAdmin('custom-fields.index');
    }

    public function postIndex(Request $request, FieldGroup $object)
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
                    $orderBy = 'title';
                }
                break;
            case 3:{
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
        if ($request->get('title', null) != null) {
            $getByFields['title'] = ['compare' => 'LIKE', 'value' => $request->get('title')];
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
            $link = asset($this->adminCpAccess . '/custom-fields/edit/' . $row->id);
            $removeLink = asset($this->adminCpAccess . '/custom-fields/delete/' . $row->id);

            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $row->id . '">',
                $row->id,
                $row->title,
                $status,
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

    public function postFastEdit(Request $request, FieldGroup $object)
    {
        $data = [
            'id' => $request->get('args_0', null),
            'title' => $request->get('args_1', null),
        ];

        $result = $object->fastEdit($data, false, true);
        return response()->json($result, $result['response_code']);
    }

    public function getEdit(Request $request, FieldGroup $object, $id = 0)
    {
        $dis = [
            'currentID' => $id,
        ];

        if (!$id == 0 && !$id < 1) {
            $item = $object->find($id);
            /*No object with this id*/
            if (!$item) {
                $this->_setFlashMessage('Item not exists.', 'error');
                $this->_showFlashMessages();
                return redirect()->back();
            }
            $dis['object'] = $item;
            $this->_setPageTitle('Edit field group', $item->global_title);

            $dis['rulesHtml'] = $this->_initRulesHtml(json_decode($item->field_rules));

            $myCustomField = new Acme\CmsCustomField();
            $dis['sortableFieldHtml'] = $myCustomField->getFieldGroupItems($id, 0);
        }
        return $this->_viewAdmin('custom-fields.edit', $dis);
    }

    public function postEdit(Request $request, FieldGroup $object, FieldItem $objectItem, $id = 0)
    {
        $data = [
            'id' => $id,
            'title' => $request->get('title', null),
            'field_rules' => $request->get('custom_fields_rules', null),
            'status' => 1,
        ];

        if ($id == 0) {
            $data['field_rules'] = json_encode([]);
            $result = $object->fastEdit($data, true, false);
        } else {
            $result = $object->fastEdit($data, false, true);
        }

        if ($result['error']) {
            $this->_setFlashMessage($result['message'], 'error');
            $this->_showFlashMessages();

            return redirect()->back();
        }

        $this->_setFlashMessage($result['message'], 'success');
        $this->_showFlashMessages();

        $deletedItems = json_decode($request->get('deleted_items'));
        if ($deletedItems) {
            $objectItem->whereIn('id', $deletedItems)
                ->orWhereIn('parent_id', $deletedItems)
                ->delete();
        }
        $items = json_decode($request->get('group_items'));
        $this->_editGroupItems($items, $result['object']->id);

        if ($id == 0) {
            return redirect()->to(asset($this->adminCpAccess . '/custom-fields/edit/' . $result['object']->id));
        }

        return redirect()->back();
    }

    public function deleteDelete(Request $request, FieldGroup $object, $id)
    {
        $result = $object->deleteFieldGroup($id);
        return response()->json($result, $result['response_code']);
    }

    private function _editGroupItems($items, $group_id, $parent = 0)
    {
        $position = 0;
        $items = (array) $items;
        foreach ($items as $key => $row) {
            $position++;
            $id = (int) $row->id;

            $item = FieldItem::findOrNew($id);
            $item->field_group_id = $group_id;
            $item->title = $row->title;
            $item->position = $position;
            $slug = str_slug($row->name, '_');
            if ($slug == '') {
                $slug = str_slug($row->title, '_');
            }
            // Check current slug has true format or not
            if ($this->_checkCurrentSlug($slug) != true) {
                $item->slug = 'temp_slug_!@#';
            }
            $item->field_type = $row->type;
            $item->options = json_encode($row->options);
            $item->instructions = $row->instructions;
            $item->parent_id = $parent;

            if ($item->save()) {
                if ($item->slug == 'temp_slug_!@#') {
                    $item->slug = $item->id . '_' . $slug;
                    $item->save();
                }
                $this->_editGroupItems($row->repeateritems, $group_id, $item->id);
            }
        }
    }

    private function _checkCurrentSlug($slug)
    {
        $exploded_slug = explode('_', $slug);
        if ((int) $exploded_slug[0] > 0) {
            return true;
        }
        return false;
    }

    private function _initRulesHtml($object_arr)
    {
        $options = [
            'pages' => $this->_getAllPages(),
            'page_templates' => _getPageTemplate('Page'),
            'post_templates' => _getPageTemplate('Post'),
            'product_templates' => _getPageTemplate('Product'),
            'category_templates' => _getPageTemplate('Category'),
            'product_category_templates' => _getPageTemplate('ProductCategory'),
            'users' => $this->_getAllUsers(),
            'roles' => $this->_getAllUserRoles(),
            'models' => [
                'Page',
                'Post',
                'Category',
                'Product',
                'ProductCategory',
            ],
        ];

        $html_src = '';
        if (!$object_arr) {
            $object_arr = array();
        }
        foreach ($object_arr as $key => $value) {
            $data_text = $value->field_relation;
            if ($data_text != 'or') {
                $data_text = '';
            }
            $html_src .= '<div class="line-group ' . $value->field_relation . '-group" data-text="' . $data_text . '" data-rel="' . $value->field_relation . '">';

            foreach ($value->field_options as $key => $value_options) {
                $html_src .= '<div class="line rule-line rule-and">';
                $html_src .= '<select name="" class="form-control pull-left rule-a" id="">';
                // Basic fields
                $html_src .= '<optgroup label="Basic">';
                // Current User Type
                $html_src .= '<option value="user_type" ' . (($value_options->rel_name == 'user_type') ? 'selected="selected"' : '') . '>Logged in User Type</option>';
                $html_src .= '</optgroup>';

                // Page group
                $html_src .= '<optgroup label="Page">';
                // Specified page
                $html_src .= '<option value="page_id" ' . (($value_options->rel_name == 'page_id') ? 'selected="selected"' : '') . '>Page</option>';
                // Page template
                $html_src .= '<option value="page_template" ' . (($value_options->rel_name == 'page_template') ? 'selected="selected"' : '') . '>Page Template</option>';
                $html_src .= '</optgroup>';

                // Post group
                $html_src .= '<optgroup label="Post">';
                $html_src .= '<option value="post_template" ' . (($value_options->rel_name == 'post_template') ? 'selected="selected"' : '') . '>Post Template</option>';
                // Category
                $html_src .= '<option value="category_id" ' . (($value_options->rel_name == 'category_id') ? 'selected="selected"' : '') . '>Category</option>';
                // Category template
                $html_src .= '<option value="category_template" ' . (($value_options->rel_name == 'category_template') ? 'selected="selected"' : '') . '>Category Template</option>';
                // Post with related category
                $html_src .= '<option value="post_with_related_category_id" ' . (($value_options->rel_name == 'post_with_related_category_id') ? 'selected="selected"' : '') . '>Post with related category</option>';
                $html_src .= '</optgroup>';

                // Product group
                $html_src .= '<optgroup label="Product">';
                $html_src .= '<option value="product_template" ' . (($value_options->rel_name == 'product_template') ? 'selected="selected"' : '') . '>Product Template</option>';
                // Product Category
                $html_src .= '<option value="product_category_id" ' . (($value_options->rel_name == 'product_category_id') ? 'selected="selected"' : '') . '>Product Category</option>';
                // Product Category template
                $html_src .= '<option value="product_category_template" ' . (($value_options->rel_name == 'product_category_template') ? 'selected="selected"' : '') . '>Product Category Template</option>';
                // Product with related category
                $html_src .= '<option value="product_with_related_product_category_id" ' . (($value_options->rel_name == 'product_with_related_product_category_id') ? 'selected="selected"' : '') . '>Product with related category</option>';
                $html_src .= '</optgroup>';

                // Other group
                $html_src .= '<optgroup label="Other">';
                // Specified user
                $html_src .= '<option value="scf_user" ' . (($value_options->rel_name == 'scf_user') ? 'selected="selected"' : '') . '>User</option>';
                // Model
                $html_src .= '<option value="model_name" ' . (($value_options->rel_name == 'model_name') ? 'selected="selected"' : '') . '>Model name</option>';
                $html_src .= '</optgroup>';
                $html_src .= '</select>';

                /*Rules type*/
                $html_src .= '<select name="" class="form-control pull-left rule-type" id="">';
                $html_src .= '<option value="==" ' . (($value_options->rel_type == '==') ? 'selected="selected"' : '') . '>is equal to</option>';
                $html_src .= '<option value="!=" ' . (($value_options->rel_type == '!=') ? 'selected="selected"' : '') . '>is not equal to</option>';
                $html_src .= '</select>';

                /*START rule b group*/
                $html_src .= '<div class="rules-b-group mar-lef-5 pull-left">';

                /*Rule: Category*/
                $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="category_id">';
                $categories = $this->recursiveGetCategoriesSelectSrc(0, 'global_title', 'asc', 0, $value_options->rel_value, [], 'category_id');
                $html_src .= $categories;
                $html_src .= '</select>';

                /*Rule: Related Category*/
                $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="post_with_related_category_id">';
                $categories = $this->recursiveGetCategoriesSelectSrc(0, 'global_title', 'asc', 0, $value_options->rel_value, [], 'post_with_related_category_id');
                $html_src .= $categories;
                $html_src .= '</select>';

                /*Rule: Product Category*/
                $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="product_category_id">';
                $categories = $this->recursiveGetProductCategoriesSelectSrc(0, 'global_title', 'asc', 0, $value_options->rel_value, [], 'product_category_id');
                $html_src .= $categories;
                $html_src .= '</select>';

                /*Rule: Related Product Category*/
                $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="product_with_related_product_category_id">';
                $categories = $this->recursiveGetProductCategoriesSelectSrc(0, 'global_title', 'asc', 0, $value_options->rel_value, [], 'product_with_related_product_category_id');
                $html_src .= $categories;
                $html_src .= '</select>';

                /*Rule: User type*/
                $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="user_type">';
                foreach ($options['roles'] as $row) {
                    $html_src .= '<option ' . (($value_options->rel_name == 'user_type' && $value_options->rel_value == $row->id) ? 'selected="selected"' : '') . ' value="' . $row->id . '">' . $row->name . '</option>';
                }
                $html_src .= '</select>';

                /*Rule: page*/
                $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="page_id">';
                foreach ($options['pages'] as $row) {
                    $html_src .= '<option value="' . $row->id . '" ' . (($value_options->rel_name == 'page_id' && $value_options->rel_value == $row->id) ? 'selected="selected"' : '') . '>' . $row->global_title . '</option>';
                }
                $html_src .= '</select>';

                /*Rule: page template*/
                $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="page_template">';
                foreach ($options['page_templates'] as $row) {
                    $html_src .= '<option value="' . $row . '" ' . (($value_options->rel_name == 'page_template' && $value_options->rel_value == $row) ? 'selected="selected"' : '') . '>' . $row . '</option>';
                }
                $html_src .= '</select>';

                /*Rule: post template*/
                $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="post_template">';
                foreach ($options['post_templates'] as $row) {
                    $html_src .= '<option value="' . $row . '" ' . (($value_options->rel_name == 'post_template' && $value_options->rel_value == $row) ? 'selected="selected"' : '') . '>' . $row . '</option>';
                }
                $html_src .= '</select>';

                /*Rule: product template*/
                $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="product_template">';
                foreach ($options['product_templates'] as $row) {
                    $html_src .= '<option value="' . $row . '" ' . (($value_options->rel_name == 'product_template' && $value_options->rel_value == $row) ? 'selected="selected"' : '') . '>' . $row . '</option>';
                }
                $html_src .= '</select>';

                /*Rule: specific user*/
                $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="scf_user">';
                foreach ($options['users'] as $row) {
                    $html_src .= '<option value="' . $row->id . '" ' . (($value_options->rel_name == 'scf_user' && $value_options->rel_value == $row->id) ? 'selected="selected"' : '') . '>' . $row->username . '</option>';
                }
                $html_src .= '</select>';

                /*Rule: category template*/
                $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="category_template">';
                foreach ($options['category_templates'] as $row) {
                    $html_src .= '<option value="' . $row . '" ' . (($value_options->rel_name == 'category_template' && $value_options->rel_value == $row) ? 'selected="selected"' : '') . '>' . $row . '</option>';
                }
                $html_src .= '</select>';

                /*Rule: product category template*/
                $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="product_category_template">';
                foreach ($options['product_category_templates'] as $row) {
                    $html_src .= '<option value="' . $row . '" ' . (($value_options->rel_name == 'product_category_template' && $value_options->rel_value == $row) ? 'selected="selected"' : '') . '>' . $row . '</option>';
                }
                $html_src .= '</select>';

                /*Rule: model name*/
                $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="model_name">';
                foreach ($options['models'] as $row) {
                    $html_src .= '<option value="' . $row . '" ' . (($value_options->rel_name == 'model_name' && $value_options->rel_value == $row) ? 'selected="selected"' : '') . '>' . $row . '</option>';
                }
                $html_src .= '</select>';

                /*END rule b group*/
                $html_src .= '</div>';

                $html_src .= '<a class="location-add-rule-and location-add-rule btn btn-primary pull-left" href="#">and</a>';
                $html_src .= '<a href="#" title="" class="remove-rule-line">-</a>';
                $html_src .= '<div class="clearfix"></div>';
                $html_src .= '</div>';
            }
            $html_src .= '</div>';
        }
        if (sizeof($object_arr) < 1) {
            $html_src .= '<div class="line-group and-group" data-text="" data-rel="and">';
            $html_src .= '<div class="line rule-line rule-and">';

            /*START rule a*/
            $html_src .= '<select name="" class="form-control pull-left rule-a" id="">';
            $html_src .= '<optgroup label="Basic">';
            $html_src .= '<option value="user_type">Logged in User Type</option>';
            $html_src .= '</optgroup>';
            $html_src .= '<optgroup label="Page">';
            $html_src .= '<option value="page_id">Page</option>';
            $html_src .= '<option value="page_template">Page Template</option>';
            $html_src .= '</optgroup>';
            $html_src .= '<optgroup label="Post">';
            $html_src .= '<option value="post_template">Post Template</option>';
            $html_src .= '<option value="category_id">Category</option>';
            $html_src .= '<option value="category_template">Category Template</option>';
            $html_src .= '<option value="post_with_related_category_id">Post with related category</option>';
            $html_src .= '</optgroup>';
            $html_src .= '<optgroup label="Product">';
            $html_src .= '<option value="product_template">Product Template</option>';
            $html_src .= '<option value="product_category_id">Product Category</option>';
            $html_src .= '<option value="product_category_template">Product Category Template</option>';
            $html_src .= '<option value="product_with_related_product_category_id">Product with related category</option>';
            $html_src .= '</optgroup>';
            $html_src .= '<optgroup label="Other">';
            $html_src .= '<option value="scf_user">User</option>';
            $html_src .= '<option value="model_name">Model name</option>';
            $html_src .= '</optgroup>';

            /*END rule a*/
            $html_src .= '</select>';

            /*Rule type*/
            $html_src .= '<select name="" class="form-control pull-left rule-type" id="">';
            $html_src .= '<option value="==">is equal to</option>';
            $html_src .= '<option value="!=">is not equal to</option>';
            $html_src .= '</select>';

            /*START rule b group*/
            $html_src .= '<div class="rules-b-group mar-lef-5 pull-left">';

            /*Rule: specific category*/
            $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="category_id">';
            $categories = $this->recursiveGetCategoriesSelectSrc(0, 'global_title', 'asc', 0);
            $html_src .= $categories;
            $html_src .= '</select>';

            /*Rule: related category*/
            $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="post_with_related_category_id">';
            $categories = $this->recursiveGetCategoriesSelectSrc(0, 'global_title', 'asc', 0);
            $html_src .= $categories;
            $html_src .= '</select>';

            /*Rule: specific product category*/
            $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="product_category_id">';
            $categories = $this->recursiveGetProductCategoriesSelectSrc(0, 'global_title', 'asc', 0);
            $html_src .= $categories;
            $html_src .= '</select>';

            /*Rule: related product category*/
            $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="product_with_related_product_category_id">';
            $categories = $this->recursiveGetProductCategoriesSelectSrc(0, 'global_title', 'asc', 0);
            $html_src .= $categories;
            $html_src .= '</select>';

            /*Rule: specific user type*/
            $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="user_type">';
            foreach ($options['roles'] as $key => $row) {
                $html_src .= '<option value="' . $row->id . '">' . $row->name . '</option>';
            }
            $html_src .= '</select>';

            /*Rule: specific page*/
            $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="page_id">';
            foreach ($options['pages'] as $key => $row) {
                $html_src .= '<option value="' . $row->id . '">' . $row->global_title . '</option>';
            }
            $html_src .= '</select>';

            /*Rule: page template*/
            $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="page_template">';
            foreach ($options['page_templates'] as $key => $row) {
                $html_src .= '<option value="' . $row . '">' . $row . '</option>';
            }
            $html_src .= '</select>';

            /*Rule: post template*/
            $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="post_template">';
            foreach ($options['post_templates'] as $key => $row) {
                $html_src .= '<option value="' . $row . '">' . $row . '</option>';
            }
            $html_src .= '</select>';

            /*Rule: product template*/
            $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="product_template">';
            foreach ($options['product_templates'] as $key => $row) {
                $html_src .= '<option value="' . $row . '">' . $row . '</option>';
            }
            $html_src .= '</select>';

            /*Rule: specific user*/
            $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="scf_user">';
            foreach ($options['users'] as $key => $row) {
                $html_src .= '<option value="' . $row->id . '">' . $row->username . '</option>';
            }
            $html_src .= '</select>';

            /*Rule: category template*/
            $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="category_template">';
            foreach ($options['category_templates'] as $row) {
                $html_src .= '<option value="' . $row . '">' . $row . '</option>';
            }
            $html_src .= '</select>';

            /*Rule: category template*/
            $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="product_category_template">';
            foreach ($options['product_category_templates'] as $row) {
                $html_src .= '<option value="' . $row . '">' . $row . '</option>';
            }
            $html_src .= '</select>';

            /*Rule: model name*/
            $html_src .= '<select name="" class="form-control rule-b hidden" id="" data-rel="model_name">';
            foreach ($options['models'] as $row) {
                $html_src .= '<option value="' . $row . '">' . $row . '</option>';
            }
            $html_src .= '</select>';

            /*END rule b group*/
            $html_src .= '</div>';
            $html_src .= '<a class="location-add-rule-and location-add-rule btn btn-primary pull-left" href="#">and</a>';
            $html_src .= '<a href="#" title="" class="remove-rule-line">-</a>';
            $html_src .= '<div class="clearfix"></div>';
            $html_src .= '</div>';
            $html_src .= '</div>';
        }
        return $html_src;
    }

    private function recursiveGetCategoriesSelectSrc($categoryId, $orderBy = 'id', $orderType = 'asc', $childText = 0, $selectedNode = 0, $exceptIds = [], $rel_name = '')
    {
        $updateTo = '';
        $child = '';
        for ($i = 0; $i < $childText; $i++) {
            $child .= '——';
        }

        $categories = Category::where('parent_id', '=', $categoryId);
        if (sizeof($exceptIds) > 0) {

            $categories = $categories->whereNotIn('id', $exceptIds);
        }
        $categories = $categories->orderBy($orderBy, $orderType)->get();

        foreach ($categories as $key => $row) {
            $updateTo .= '<option value="' . $row->id . '"' . (($row->id == (int) $selectedNode && $rel_name == 'category_id') ? ' selected="selected"' : '') . '>' . $child . ' ' . $row->global_title . '</option>';
            $updateTo .= $this->recursiveGetCategoriesSelectSrc($row->id, $orderBy, $orderType, $childText + 1, $selectedNode, $exceptIds, $rel_name);

        }
        return $updateTo;
    }

    private function recursiveGetProductCategoriesSelectSrc($categoryId, $orderBy = 'id', $orderType = 'asc', $childText = 0, $selectedNode = 0, $exceptIds = [], $rel_name = '')
    {
        $updateTo = '';
        $child = '';
        for ($i = 0; $i < $childText; $i++) {
            $child .= '——';
        }

        $categories = ProductCategory::where('parent_id', '=', $categoryId);
        if (sizeof($exceptIds) > 0) {

            $categories = $categories->whereNotIn('id', $exceptIds);
        }
        $categories = $categories->orderBy($orderBy, $orderType)->get();

        foreach ($categories as $key => $row) {
            $updateTo .= '<option value="' . $row->id . '"' . (($row->id == (int) $selectedNode && $rel_name == 'category_id') ? ' selected="selected"' : '') . '>' . $child . ' ' . $row->global_title . '</option>';
            $updateTo .= $this->recursiveGetProductCategoriesSelectSrc($row->id, $orderBy, $orderType, $childText + 1, $selectedNode, $exceptIds, $rel_name);

        }
        return $updateTo;
    }

    private function _getAllUserRoles()
    {
        $result = [];

        $roles = AdminUserRole::select('id', 'name')->get();
        foreach ($roles as $key => $row) {
            $role = new \stdClass();
            $role->id = $row->id;
            $role->name = $row->name;

            array_push($result, $role);
        }

        return $result;
    }

    private function _getAllPages()
    {
        $result = [];

        $pages = Page::getBy([], [
            'global_title' => 'ASC',
        ], true);
        foreach ($pages as $key => $row) {
            $page = new \stdClass();
            $page->id = $row->id;
            $page->global_title = $row->global_title;

            array_push($result, $page);
        }
        return $result;
    }

    /*Get all users*/
    private function _getAllUsers()
    {
        $result = [];

        $users = AdminUser::getBy([
            'status' => 1,
        ], [
            'id' => 'ASC',
        ], true);
        foreach ($users as $key => $row) {
            $user = new \stdClass();
            $user->id = $row->id;
            $user->username = $row->username;

            array_push($result, $user);
        }
        return $result;
    }
}
