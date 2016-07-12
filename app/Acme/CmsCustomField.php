<?php namespace Acme;

use App\Models\CategoryMeta;
use App\Models\FieldGroup;
use App\Models\FieldItem;
use App\Models\PageMeta;
use App\Models\PostMeta;
use App\Models\ProductCategoryMeta;
use App\Models\ProductMeta;

/**
 * User: Tedozi
 * Date: 07/02/2015
 * Time: 4:57 PM
 **/
class CmsCustomField
{
    /**
     * Construct
     **/
    public function __construct()
    {

    }

    public function getGroupNodes($group_id, $parent_id)
    {
        $fieldItems = FieldItem::getBy([
            'field_group_id' => $group_id,
            'parent_id' => $parent_id,
        ], [
            'position' => 'ASC',
        ], true);
        return $fieldItems;
    }

    public function getFieldGroupItems($group_id)
    {
        $fieldItems = $this->getGroupNodes($group_id, 0);

        $html_src = view('admin._partials.custom-fields._field-group-items', ['fieldItems' => $fieldItems, 'object' => $this, 'isRepeater' => false])->render();
        return $html_src;
    }

    public function _getOptionCustomFields($type, $options, $current_id = 0)
    {
        if (!property_exists($options, 'defaultvalue')) {
            $options->defaultvalue = '';
        }

        if (!property_exists($options, 'placeholdertext')) {
            $options->placeholdertext = '';
        }

        if (!property_exists($options, 'defaultvaluetextarea')) {
            $options->defaultvaluetextarea = '';
        }

        if (!property_exists($options, 'wyswygtoolbar')) {
            $options->wyswygtoolbar = 'basic';
        }

        if (!property_exists($options, 'selectchoices')) {
            $options->selectchoices = '';
        }

        if (!property_exists($options, 'buttonlabel')) {
            $options->buttonlabel = '';
        }

        $data = ['options' => $options, 'currentId' => $current_id];

        $html_src = '';
        $defaultvalue = view('admin._partials.custom-fields.options._default-value', $data)->render();
        $placeholdertext = view('admin._partials.custom-fields.options._placeholder', $data)->render();
        $defaultvaluetextarea = view('admin._partials.custom-fields.options._default-value-textarea', $data)->render();
        $wyswygtoolbar = view('admin._partials.custom-fields.options._wysiwyg-toolbar', $data)->render();
        $selectchoices = view('admin._partials.custom-fields.options._select-choices', $data)->render();
        $buttonlabel = view('admin._partials.custom-fields.options._button-label', $data)->render();
        $repeater = '';

        switch ($type) {
            case 'text': {
                $html_src .= $defaultvalue . $placeholdertext;
            }
                break;
            case 'textarea': {
                $html_src .= $defaultvaluetextarea . $placeholdertext;
            }
                break;
            case 'number': {
                $html_src .= $defaultvaluetextarea . $placeholdertext;
            }
                break;
            case 'email': {
                $html_src .= $defaultvalue . $placeholdertext;
            }
                break;
            case 'password': {
                $html_src .= $defaultvalue . $placeholdertext;
            }
                break;
            case 'wyswyg': {
                $html_src .= $defaultvaluetextarea . $placeholdertext . $wyswygtoolbar;
            }
                break;
            case 'image': {
                return $html_src;
            }
                break;
            case 'file': {
                return $html_src;
            }
                break;
            case 'select': {
                $html_src .= $selectchoices . $defaultvalue;
            }
                break;
            case 'checkbox': {
                $html_src .= $selectchoices . $defaultvalue;
            }
                break;
            case 'radio': {
                $html_src .= $selectchoices . $defaultvalue;
            }
                break;
            case 'repeater': {
                $html_src .= $repeater . $buttonlabel;
            }
                break;
            default: {
                return $html_src;
            }
                break;
        }
        return $html_src;
    }

    // Get custom fields boxes
    public function getCustomFieldsBoxes($content_id, $args_rules = array(), $use_for = '')
    {
        $field_groups = FieldGroup::getBy([
            'status' => 1
        ], [
            'created_at' => 'ASC'
        ], true);

        $html_src = view('admin._partials.custom-fields.boxes._field-group', [
            'fieldGroups' => $field_groups,
            'useFor' => $use_for,
            'rules' => $args_rules,
            'contentId' => $content_id,
            'object' => $this
        ])->render();
        return $html_src;
    }

    public function _getCustomFieldsBoxItems($fieldItem, $content_id = 0, $use_for = '')
    {
        $html_src = '';
        $options = json_decode($fieldItem->options);
        $theMeta = '';
        switch ($use_for) {
            case 'category': {
                $theMeta = \App\Models\CategoryMeta::getContentMeta($content_id, $fieldItem->slug);
            }
                break;
            case 'product': {
                $theMeta = \App\Models\ProductMeta::getContentMeta($content_id, $fieldItem->slug);
            }
                break;
            case 'product-category': {
                $theMeta = \App\Models\ProductCategoryMeta::getContentMeta($content_id, $fieldItem->slug);
            }
                break;
            case 'page': {
                $theMeta = \App\Models\PageMeta::getContentMeta($content_id, $fieldItem->slug);
            }
                break;
            case 'post':
            default: {
                $theMeta = \App\Models\PostMeta::getContentMeta($content_id, $fieldItem->slug);
            }
                break;
        }
        if (!$theMeta && property_exists($options, 'defaultvalue')) {
            $theMeta = $options->defaultvalue;
        }

        $data = ['theMeta' => $theMeta, 'fieldItem' => $fieldItem, 'options' => $options, 'object' => $this];
        $view = 'admin._partials.custom-fields.boxes';

        switch ($fieldItem->field_type) {
            case 'text': {
                $view .= '._text';
            }
                break;
            case 'textarea': {
                $view .= '._textarea';
            }
                break;
            case 'number': {
                $view .= '._number';
            }
                break;
            case 'email': {
                $view .= '._email';
            }
                break;
            case 'password': {
                $view .= '._password';
            }
                break;
            case 'wyswyg': {
                $view .= '._wysiwyg';
            }
                break;
            case 'image': {
                $view .= '._image';
            }
                break;
            case 'file': {
                $view .= '._file';
            }
                break;
            case 'select': {
                $view .= '._select';
            }
                break;
            case 'checkbox': {
                $view .= '._checkbox';
            }
                break;
            case 'radio': {
                $view .= '._radio';
            }
                break;
            case 'repeater': {
                $view .= '._repeater';
            }
                break;
            default: {
                return '';
            }
                break;
        }
        return view($view, $data)->render();
    }

    public function _getRepeaterItems($group_id, $parent_id = 0)
    {
        $fieldItems = FieldItem::getBy([
            'field_group_id' => $group_id,
            'parent_id' => $parent_id,
        ], [
            'position' => 'ASC',
        ], true);
        $result = [];
        foreach ($fieldItems as $key => $row) {
            $item = new \stdClass();
            $item->slug = $row->slug;
            $item->title = $row->title;
            $item->field_type = $row->field_type;
            $item->instructions = $row->instructions;
            $item->options = json_decode($row->options);

            if($item->field_type == 'checkbox') {
                $item->options->defaultvalue = json_encode($item->options->defaultvalue);
            }

            $result[] = $item;
        }
        return $result;
    }

    public function initRepeaterFieldLine($items, $repeater_field, $current = 0)
    {
        $html_src = '';
        $size_of_repeater = sizeof($repeater_field);
        $size_of_items = sizeof($items);

        foreach ($repeater_field as $key => $row) {
            if ($size_of_repeater < $size_of_items) {
                break;
            }

            $currentRepeaterKey = -1;
            foreach ($items as $key2 => $row2) {
                if (property_exists($row, 'slug') && property_exists($row2, 'slug')) {
                    if ($row->slug == $row2->slug) {
                        $currentRepeaterKey = $key2;
                    }
                }
            }

            $subField = new \stdClass();
            $subField->field_type = $row->field_type;

            $subField->slug = $row->slug;
            $subField->field_type_updated = $row->field_type;

            if($currentRepeaterKey > -1) {
                $subField->field_value = $items[$currentRepeaterKey]->field_value;
            } else {
                $subField->field_value = $row->options->defaultvalue;
            }

            $options = $row->options;

            $data = [
                'subField' => $subField,
                'key' => ($key + 1),
                'currentRepeaterKey' => $key,
                'object' => $this,
                'current' => $current,
                'options' => $options,
                'repeaterField' => $repeater_field
            ];

            $html_src .= view('admin._partials.custom-fields.boxes._repeater-field-line', $data)->render();
        }

        return $html_src;
    }

    public function initRepeaterInputItem($sub_field, $options, $current = 0)
    {
        $html_src = '';
        $view = 'admin._partials.custom-fields.boxes';
        $data = [
            'fieldItem' => $sub_field,
            'options' => $options,
            'theMeta' => $sub_field->field_value,
            'current' => $current
        ];

        switch ($sub_field->field_type_updated) {
            case 'text': {
                $html_src .= view($view.'._repeater-text', $data)->render();
            }
                break;
            case 'textarea': {
                $html_src .= view($view.'._repeater-textarea', $data)->render();
            }
                break;
            case 'number': {
                $html_src .= view($view.'._repeater-number', $data)->render();
            }
                break;
            case 'email': {
                $html_src .= view($view.'._repeater-email', $data)->render();
            }
                break;
            case 'password': {
                $html_src .= view($view.'._repeater-password', $data)->render();
            }
                break;
            case 'wyswyg': {
                $html_src .= view($view.'._repeater-wysiwyg', $data)->render();
            }
                break;
            case 'image': {
                $html_src .= view($view.'._repeater-image', $data)->render();
            }
                break;
            case 'file': {
                $html_src .= view($view.'._repeater-file', $data)->render();
            }
                break;
            case 'select': {
                $html_src .= view($view.'._repeater-select', $data)->render();
            }
                break;
            case 'checkbox': {
                $html_src .= view($view.'._repeater-checkbox', $data)->render();
            }
                break;
            case 'radio': {
                $html_src .= view($view.'._repeater-radio', $data)->render();
            }
                break;
            case 'repeater': {
                return $html_src;
            }
                break;
            default: {
                return $html_src;
            }
                break;
        }
        return $html_src;
    }

    /*Check rules*/
    public function _checkRules($args, $field_group)
    {
        $default_args = [
            'user_type' => 1,
            'category_id' => 0,
            'category_template' => '',
            'product_category_id' => 0,
            'product_category_template' => '',
            'page_id' => 0,
            'page_template' => '',
            'scf_user' => 0,
            'model_name' => '',
            'product_with_related_product_category_id' => 0,
            'post_with_related_category_id' => 0,
        ];
        $args = array_merge($default_args, $args);

        $flag = false;

        $rules = json_decode($field_group->field_rules);
        if (is_array($rules)) {
            foreach ($rules as $key_rule => $rule) {
                if ($this->_checkEachRule($rule->field_options, $args) == true) {
                    $flag = true;
                }
            }
        }
        return $flag;
    }

    function _checkEachRule($rules, $args)
    {
        $flag = true;
        foreach ($rules as $key => $row) {
            if (!isset($args[$row->rel_name])) {
                $flag = false;
            } else {
                if ($row->rel_type == '==') {
                    if (is_array($args[$row->rel_name])) {
                        if (!in_array($row->rel_value, $args[$row->rel_name])) {
                            $flag = false;
                        }
                    } else {
                        if ($row->rel_value != $args[$row->rel_name]) {
                            $flag = false;
                        }
                    }

                } else {
                    if (is_array($args[$row->rel_name])) {
                        if (in_array($row->rel_value, $args[$row->rel_name])) {
                            $flag = false;
                        }
                    } else {
                        if ($row->rel_value == $args[$row->rel_name]) {
                            $flag = false;
                        }
                    }
                }
            }

        }
        return $flag;
    }
    /*Check rules*/

    /*#*****************end custom fields**********************/
}
