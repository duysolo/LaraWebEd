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

    // Get options
    public function getOptionHtml($type, $options, $current_id = 0)
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

        $html_src = '';
        $defaultvalue = '<div class="line" data-option="defaultvalue"><div class="col-xs-3"><h5>Default Value</h5><p>Appears when creating a new post</p></div><div class="col-xs-9"><input type="text" class="form-control" placeholder="" value="' . $options->defaultvalue . '"></div><div class="clearfix"></div></div>';
        $placeholdertext = '<div class="line" data-option="placeholdertext"><div class="col-xs-3"><h5>Placeholder Text</h5><p>Appears within the input</p></div><div class="col-xs-9"><input type="text" class="form-control" placeholder="" value="' . $options->placeholdertext . '"></div><div class="clearfix"></div></div>';
        $defaultvaluetextarea = '<div class="line" data-option="defaultvaluetextarea"><div class="col-xs-3"><h5>Default Value</h5><p>Appears when creating a new post</p></div><div class="col-xs-9"><textarea class="form-control" rows="3">' . $options->defaultvaluetextarea . '</textarea></div><div class="clearfix"></div></div>';
        $wyswygtoolbar = '<div class="line" data-option="wyswygtoolbar"><div class="col-xs-3"><h5>Toolbar</h5></div><div class="col-xs-9"><label><input type="radio" placeholder="" name="radio_wyswygtoolbar_id_' . $current_id . '" value="full"' . (($options->wyswygtoolbar == 'full') ? ' checked="checked"' : '') . ' class="radio-wyswygtoolbar form-control">Full</label><label><input type="radio" placeholder="" name="radio_wyswygtoolbar_id_' . $current_id . '" value="basic"' . (($options->wyswygtoolbar == 'basic') ? ' checked="checked"' : '') . ' class="radio-wyswygtoolbar form-control">Basic</label></div><div class="clearfix"></div></div>';
        $selectchoices = '<div class="line" data-option="selectchoices"><div class="col-xs-3"><h5>Choices</h5><p>Enter each choice on a new line.<br> For more control, you may specify both a value and label like this:<br>red: Red<br>blue: Blue</p></div><div class="col-xs-9"><textarea class="form-control" rows="3">' . $options->selectchoices . '</textarea></div><div class="clearfix"></div></div>';
        $buttonlabel = '<div class="line" data-option="buttonlabel"><div class="col-xs-3"><h5>Button label</h5></div><div class="col-xs-9"><input type="text" class="form-control" placeholder="" value="' . $options->buttonlabel . '"></div><div class="clearfix"></div></div>';
        $repeater = '';

        switch ($type) {
            case 'text':{
                    $html_src .= $defaultvalue . $placeholdertext;
                }
                break;
            case 'textarea':{
                    $html_src .= $defaultvaluetextarea . $placeholdertext;
                }
                break;
            case 'number':{
                    $html_src .= $defaultvaluetextarea . $placeholdertext;
                }
                break;
            case 'email':{
                    $html_src .= $defaultvalue . $placeholdertext;
                }
                break;
            case 'password':{
                    $html_src .= $defaultvalue . $placeholdertext;
                }
                break;
            case 'wyswyg':{
                    $html_src .= $defaultvaluetextarea . $placeholdertext . $wyswygtoolbar;
                }
                break;
            case 'image':{
                    return $html_src;
                }
                break;
            case 'file':{
                    return $html_src;
                }
                break;
            case 'select':{
                    $html_src .= $selectchoices . $defaultvalue;
                }
                break;
            case 'checkbox':{
                    $html_src .= $selectchoices . $defaultvalue;
                }
                break;
            case 'radio':{
                    $html_src .= $selectchoices . $defaultvalue;
                }
                break;
            case 'repeater':{
                    $html_src .= $repeater . $buttonlabel;
                }
                break;
            default:{
                    return $html_src;
                }
                break;
        }
        return $html_src;
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

    public function getFieldGroupItems($group_id, $parent_id, $disable_sort = false)
    {
        $html_src = '';
        $field_items = $this->getGroupNodes($group_id, $parent_id);
        $html_src .= '<ul class="sortable-wrapper ' . (($disable_sort == true) ? '' : '') . '">';
        foreach ($field_items as $key => $row):
            $html_src .= '<li class="" data-position="' . ($key + 1) . '" data-repeateritems=\'\' data-options=\'\' data-id="' . $row->id . '" data-name="' . $row->slug . '" data-title="' . $row->title . '" data-type="' . $row->field_type . '" data-instructions="' . $row->instructions . '">';
            $html_src .= '<div class="field-column">';
            $html_src .= '<div class="text col-xs-4 field-label">' . ((trim($row->title) != '') ? $row->title : '&nbsp;') . '</div>';
            $html_src .= '<div class="text col-xs-4 field-name">' . ((trim($row->slug) != '') ? $row->slug : '&nbsp;') . '</div>';
            $html_src .= '<div class="text col-xs-4 field-type">' . ((trim($row->field_type) != '') ? $row->field_type : '&nbsp;') . '</div>';
            $html_src .= '<a class="show-item-details" title="" href="#"><i class="fa fa-angle-down"></i></a>';
            $html_src .= '<div class="clearfix"></div>';
            $html_src .= '</div>';
            $html_src .= '<div class="item-details">';
            $html_src .= '<div class="line" data-option="title">';
            $html_src .= '<div class="col-xs-3">';
            $html_src .= '<h5>Field Label</h5>';
            $html_src .= '<p>This is the name which will appear on the EDIT page</p>';
            $html_src .= '</div>';
            $html_src .= '<div class="col-xs-9">';
            $html_src .= '<input type="text" class="form-control" placeholder="" value="' . htmlentities($row->title) . '">';
            $html_src .= '</div>';
            $html_src .= '<div class="clearfix"></div>';
            $html_src .= '</div>';
            $html_src .= '<div class="line" data-option="instructions">';
            $html_src .= '<div class="col-xs-3">';
            $html_src .= '<h5>Field Instructions</h5>';
            $html_src .= '<p>Instructions for authors. Shown when submitting data</p>';
            $html_src .= '</div>';
            $html_src .= '<div class="col-xs-9">';
            $html_src .= '<input type="text" class="form-control" placeholder="" value="' . htmlentities($row->instructions) . '">';
            $html_src .= '</div>';
            $html_src .= '<div class="clearfix"></div>';
            $html_src .= '</div>';
            $html_src .= '<div class="line" data-option="name">';
            $html_src .= '<div class="col-xs-3">';
            $html_src .= '<h5>Field Name</h5>';
            $html_src .= '<p>Single word, no spaces. Underscores and dashes allowed</p>';
            $html_src .= '</div>';
            $html_src .= '<div class="col-xs-9">';
            $html_src .= '<input type="text" class="form-control" placeholder="" value="' . htmlentities($row->slug) . '">';
            $html_src .= '</div>';
            $html_src .= '<div class="clearfix"></div>';
            $html_src .= '</div>';
            $html_src .= '<div class="line" data-option="type">';
            $html_src .= '<div class="col-xs-3">';
            $html_src .= '<h5>Field Type</h5>';
            $html_src .= '</div>';
            $html_src .= '<div class="col-xs-9">';
            $html_src .= '<select name="" class="form-control change-field-type">';
            $html_src .= '<optgroup label="Basic">';
            $html_src .= ' <option value="text"' . (($row->field_type == 'text') ? ' selected="selected"' : '') . '>Text</option>';
            $html_src .= '<option value="textarea"' . (($row->field_type == 'textarea') ? ' selected="selected"' : '') . '>Textarea</option>';
            $html_src .= '<option value="number"' . (($row->field_type == 'number') ? ' selected="selected"' : '') . '>Number</option>';
            $html_src .= '<option value="email"' . (($row->field_type == 'email') ? ' selected="selected"' : '') . '>Email</option>';
            $html_src .= '<option value="password"' . (($row->field_type == 'password') ? ' selected="selected"' : '') . '>Password</option>';
            $html_src .= '</optgroup>';
            $html_src .= '<optgroup label="Content">';
            $html_src .= '<option value="wyswyg"' . (($row->field_type == 'wyswyg') ? ' selected="selected"' : '') . '>WYSWYG editor</option>';
            $html_src .= '<option value="image"' . (($row->field_type == 'image') ? ' selected="selected"' : '') . '>Image</option>';
            $html_src .= '<option value="file"' . (($row->field_type == 'file') ? ' selected="selected"' : '') . '>File</option>';
            $html_src .= '</optgroup>';
            $html_src .= '<optgroup label="Choice">';
            $html_src .= '<option value="select"' . (($row->field_type == 'select') ? ' selected="selected"' : '') . '>Select</option>';
            $html_src .= '<option value="checkbox"' . (($row->field_type == 'checkbox') ? ' selected="selected"' : '') . '>Checkbox</option>';
            $html_src .= '<option value="radio"' . (($row->field_type == 'radio') ? ' selected="selected"' : '') . '>Radio button</option>';
            $html_src .= '</optgroup>';
            $html_src .= '<optgroup label="Other">';
            $html_src .= '<option value="repeater"' . (($row->field_type == 'repeater') ? ' selected="selected"' : '') . '>Repeater</option>';
            $html_src .= '</optgroup>';
            $html_src .= '</select>';
            $html_src .= '</div>';
            $html_src .= '<div class="clearfix"></div>';
            $html_src .= '</div>';
            $html_src .= '<div class="options">';

            if ($row->field_type == 'repeater'):
                $html_src .= '<div class="line" data-option="repeater">';
                $html_src .= '<div class="col-xs-3">';
                $html_src .= '<h5>Repeater fields</h5>';
                $html_src .= '</div>';
                $html_src .= '<div class="col-xs-9">';
                $html_src .= '<div class="add-new-field">';
                $html_src .= '<ul class="list-group field-table-header">';
                $html_src .= '<li class="col-xs-4 list-group-item w-bold">Field Label</li>';
                $html_src .= '<li class="col-xs-4 list-group-item w-bold">Field Name</li>';
                $html_src .= '<li class="col-xs-4 list-group-item w-bold">Field Type</li>';
                $html_src .= '</ul>';
                $html_src .= '<div class="clearfix"></div>';
                $html_src .= $this->getFieldGroupItems($group_id, $row->id, true);
                $html_src .= '<div class="text-right pad-top-10">';
                $html_src .= '<a class="btn red btn-add-field" title="" href="repeater" id="">Add field</a>';
                $html_src .= '</div>';
                $html_src .= '</div>';
                $html_src .= '</div>';
                $html_src .= '<div class="clearfix"></div>';
                $html_src .= '</div>';
            endif;

            $options = json_decode($row->options);
            $html_src .= $this->getOptionHtml($row->field_type, $options, $row->id);
            $html_src .= '</div>';
            $html_src .= '<div class="text-right pad-top-10 pad-bot-10 pad-rig-10">';
            $html_src .= '<a class="btn red btn-remove" title="" href="#">Remove</a>';
            $html_src .= '<a class="btn blue btn-close-field" title="" href="#">Close fields</a>';
            $html_src .= '</div>';
            $html_src .= '</div>';
            $html_src .= '</li>';
        endforeach;
        $html_src .= '</ul>';
        return $html_src;
    }

    // Get custom fields boxes
    public function getCustomFieldsBoxes($content_id, $args_rules = array(), $use_for = '')
    {
        $html_src = '';
        $field_groups = FieldGroup::orderBy('created_at', 'ASC')->get();
        foreach ($field_groups as $key => $row) {
            if (is_array($args_rules) && $this->checkRules($args_rules, $row)) {
                $html_src .= '<div class="portlet light bordered meta-boxes">';
                $html_src .= '<div class="portlet-title">';
                $html_src .= '<div class="caption">';
                $html_src .= '<i class="icon-note font-dark"></i>';
                $html_src .= '<span class="caption-subject font-dark sbold uppercase">' . $row->title . '</span>';
                $html_src .= '</div>';
                $html_src .= '<div class="tools">';
                $html_src .= '<a class="collapse" href="" data-original-title="" title=""></a>';
                $html_src .= '<a class="fullscreen" href="" data-original-title="" title=""></a>';
                $html_src .= '</div>';
                $html_src .= '</div>';
                $html_src .= '<div class="portlet-body">';

                $group_nodes = $this->getGroupNodes($row->id, 0);
                foreach ($group_nodes as $key2 => $group_node) {
                    $html_src .= $this->getCustomFieldsBoxItems($group_node, $content_id, $use_for);
                }

                $html_src .= '</div>';
                $html_src .= '</div>';
            }
        }
        return $html_src;
    }

    /*Get custom fields box items*/
    public function getCustomFieldsBoxItems($field_item, $content_id = 0, $use_for = '')
    {
        $html_src = '';
        $options = json_decode($field_item->options);
        $the_meta = '';
        switch ($use_for) {
            case 'category':{
                    $the_meta = CategoryMeta::getContentMeta($content_id, $field_item->slug);
                }
                break;
            case 'product':{
                    $the_meta = ProductMeta::getContentMeta($content_id, $field_item->slug);
                }
                break;
            case 'product-category':{
                    $the_meta = ProductCategoryMeta::getContentMeta($content_id, $field_item->slug);
                }
                break;
            case 'page':{
                    $the_meta = PageMeta::getContentMeta($content_id, $field_item->slug);
                }
                break;
            default:{
                    $the_meta = PostMeta::getContentMeta($content_id, $field_item->slug);
                }
                break;
        }
        if (!$the_meta && property_exists($options, 'defaultvalue')) {
            $the_meta = $options->defaultvalue;
        }

        switch ($field_item->field_type) {
            case 'text':{
                    $html_src .= '<div class="meta-box normal-box" data-slug="' . $field_item->slug . '">';
                    $html_src .= '<p>';
                    $html_src .= '<label class="sbold">' . $field_item->title . '</label><br>';
                    $html_src .= '<span class="font-size-13">' . $field_item->instructions . '</span>';
                    $html_src .= '</p>';
                    $html_src .= '<div class="scf-text-wrap">';
                    $html_src .= '<input type="text" data-fieldtype="' . $field_item->field_type . '" data-slug="' . $field_item->slug . '" value="' . $the_meta . '" placeholder="' . $options->placeholdertext . '" class="form-control">';
                    $html_src .= '</div>';
                    $html_src .= '</div>';
                }
                break;
            case 'textarea':{
                    $html_src .= '<div class="meta-box textarea-box" data-slug="' . $field_item->slug . '">';
                    $html_src .= '<p>';
                    $html_src .= '<label class="sbold">' . $field_item->title . '</label><br>';
                    $html_src .= '<span class="font-size-13">' . $field_item->instructions . '</span>';
                    $html_src .= '</p>';
                    $html_src .= '<div class="scf-textarea-wrap">';
                    $html_src .= '<textarea rows="3" value="" data-fieldtype="' . $field_item->field_type . '" data-slug="' . $field_item->slug . '" placeholder="' . $options->placeholdertext . '" class="form-control">' . $the_meta . '</textarea>';
                    $html_src .= '</div>';
                    $html_src .= '</div>';
                }
                break;
            case 'number':{
                    $html_src .= '<div class="meta-box normal-box" data-slug="' . $field_item->slug . '">';
                    $html_src .= '<p>';
                    $html_src .= '<label class="sbold">' . $field_item->title . '</label><br>';
                    $html_src .= '<span class="font-size-13">' . $field_item->instructions . '</span>';
                    $html_src .= '</p>';
                    $html_src .= '<div class="scf-number-wrap">';
                    $html_src .= '<input type="number" data-fieldtype="' . $field_item->field_type . '" data-slug="' . $field_item->slug . '" value="' . $the_meta . '" placeholder="' . $options->placeholdertext . '" class="form-control">';
                    $html_src .= '</div>';
                    $html_src .= '</div>';
                }
                break;
            case 'email':{
                    $html_src .= '<div class="meta-box normal-box" data-slug="' . $field_item->slug . '">';
                    $html_src .= '<p>';
                    $html_src .= '<label class="sbold">' . $field_item->title . '</label><br>';
                    $html_src .= '<span class="font-size-13">' . $field_item->instructions . '</span>';
                    $html_src .= '</p>';
                    $html_src .= '<div class="scf-email-wrap">';
                    $html_src .= '<input type="email" data-fieldtype="' . $field_item->field_type . '" data-slug="' . $field_item->slug . '" value="' . $the_meta . '" placeholder="' . $options->placeholdertext . '" class="form-control">';
                    $html_src .= '</div>';
                    $html_src .= '</div>';
                }
                break;
            case 'password':{
                    $html_src .= '<div class="meta-box normal-box" data-slug="' . $field_item->slug . '">';
                    $html_src .= '<p>';
                    $html_src .= '<label class="sbold">' . $field_item->title . '</label><br>';
                    $html_src .= '<span class="font-size-13">' . $field_item->instructions . '</span>';
                    $html_src .= '</p>';
                    $html_src .= '<div class="scf-password-wrap">';
                    $html_src .= '<input type="password" data-fieldtype="' . $field_item->field_type . '" data-slug="' . $field_item->slug . '" value="' . $the_meta . '" placeholder="' . $options->placeholdertext . '" class="form-control">';
                    $html_src .= '</div>';
                    $html_src .= '</div>';
                }
                break;
            case 'wyswyg':{
                    $html_src .= '<div class="meta-box textarea-box" data-slug="' . $field_item->slug . '">';
                    $html_src .= '<p>';
                    $html_src .= '<label class="sbold">' . $field_item->title . '</label><br>';
                    $html_src .= '<span class="font-size-13">' . $field_item->instructions . '</span>';
                    $html_src .= '</p>';
                    $html_src .= '<div class="scf-wyswyg-wrap scf-textarea-wrap">';
                    $html_src .= '<script>';
                    $html_src .= '$(document).ready(function() {';
                    $html_src .= 'CKEDITOR.replace( "wyswyg_editor_field_' . $field_item->slug . $field_item->id . '", {';
                    if ($options->wyswygtoolbar == 'basic') {
                        $html_src .= 'toolbar: [[\'mode\', \'Source\', \'Image\', \'TextColor\', \'BGColor\', \'Styles\', \'Format\', \'Font\', \'FontSize\', \'CreateDiv\', \'PageBreak\', \'Bold\', \'Italic\', \'Underline\', \'Strike\', \'Subscript\', \'Superscript\', \'RemoveFormat\']],';
                    }
                    $html_src .= '});';
                    $html_src .= '});';
                    $html_src .= '</script>';
                    $html_src .= '<textarea rows="3" value="" name="wyswyg_editor_field_' . $field_item->slug . $field_item->id . '" id="wyswyg_editor_field_' . $field_item->slug . $field_item->id . '" data-fieldtype="' . $field_item->field_type . '" data-slug="' . $field_item->slug . '" placeholder="' . $options->placeholdertext . '" class="form-control wyswyg-editor">' . $the_meta . '</textarea>';
                    $html_src .= '</div>';
                    $html_src .= '</div>';
                }
                break;
            case 'image':{
                    $img_src = $the_meta;
                    if ((string) $img_src == '') {
                        $img_src = '/admin/images/no-image.png';
                    }
                    $html_src .= '<div class="meta-box normal-box" data-slug="' . $field_item->slug . '">';
                    $html_src .= '<p>';
                    $html_src .= '<label class="sbold">' . $field_item->title . '</label><br>';
                    $html_src .= '<span class="font-size-13">' . $field_item->instructions . '</span>';
                    $html_src .= '</p>';
                    $html_src .= '<div class="scf-image-wrap">';
                    $html_src .= '<div class="select-media-box">';
                    $html_src .= '<a title="" class="btn blue show-add-media-popup">Choose image</a>';
                    $html_src .= '<div class="clearfix"></div>';
                    $html_src .= '<a title="" class="show-add-media-popup"><img src="' . asset($img_src) . '" alt="" class="img-responsive"></a>';
                    $html_src .= '<input type="hidden"" data-slug="' . $field_item->slug . '" data-fieldtype="' . $field_item->field_type . '" value="' . $the_meta . '" class="input-file">';
                    $html_src .= '<a href="#" title="" class="remove-image"><span>&nbsp;</span></a>';
                    $html_src .= '</div>';
                    $html_src .= '</div>';
                    $html_src .= '</div>';
                }
                break;
            case 'file':{

                    $file_src = $the_meta;
                    $img_src = '/admin/images/no-image.png';

                    $html_src .= '<div class="meta-box normal-box" data-slug="' . $field_item->slug . '">';
                    $html_src .= '<p>';
                    $html_src .= '<label class="sbold">' . $field_item->title . '</label><br>';
                    $html_src .= '<span class="font-size-13">' . $field_item->instructions . '</span>';
                    $html_src .= '</p>';
                    $html_src .= '<div class="scf-file-wrap">';
                    $html_src .= '<div class="select-media-box select-file-box">';
                    $html_src .= '<a title="" class="btn blue show-add-media-popup select-file-box">Choose file</a>';
                    $html_src .= '<div class="clearfix"></div>';
                    $html_src .= '<a title="" class="show-add-media-popup select-file-box"><img src="' . asset($img_src) . '" alt="" class="img-responsive"><span class="title">' . $file_src . '</span></a>';
                    $html_src .= '<input type="hidden"" data-slug="' . $field_item->slug . '" data-fieldtype="' . $field_item->field_type . '" value="' . $file_src . '" class="input-file">';
                    $html_src .= '<a href="#" title="" class="remove-image"><span>&nbsp;</span></a>';
                    $html_src .= '</div>';
                    $html_src .= '</div>';
                    $html_src .= '</div>';
                }
                break;
            case 'select':{
                    $html_src .= '<div class="meta-box select-box" data-slug="' . $field_item->slug . '">';
                    $html_src .= '<p>';
                    $html_src .= '<label class="sbold">' . $field_item->title . '</label><br>';
                    $html_src .= '<span class="font-size-13">' . $field_item->instructions . '</span>';
                    $html_src .= '</p>';
                    $html_src .= '<div class="scf-select-wrap">';
                    $html_src .= '<select class="form-control" data-fieldtype="' . $field_item->field_type . '" data-slug="' . $field_item->slug . '">';
                    $html_src .= $this->getChoicesOfSelect($options->selectchoices, $the_meta);
                    $html_src .= '</select>';
                    $html_src .= '</div>';
                    $html_src .= '</div>';
                }
                break;
            case 'checkbox':{
                    $html_src .= '<div class="meta-box check-box" data-slug="' . $field_item->slug . '">';
                    $html_src .= '<p>';
                    $html_src .= '<label class="sbold">' . $field_item->title . '</label><br>';
                    $html_src .= '<span class="font-size-13">' . $field_item->instructions . '</span>';
                    $html_src .= '</p>';
                    $html_src .= '<div class="scf-checkbox-wrap">';
                    $html_src .= $this->getChoicesOfCheckbox($options->selectchoices, $the_meta, ['field_type' => $field_item->field_type, 'slug' => $field_item->slug]);
                    $html_src .= '</div>';
                    $html_src .= '</div>';
                }
                break;
            case 'radio':{
                    $html_src .= '<div class="meta-box radio-box" data-slug="' . $field_item->slug . '">';
                    $html_src .= '<p>';
                    $html_src .= '<label class="sbold">' . $field_item->title . '</label><br>';
                    $html_src .= '<span class="font-size-13">' . $field_item->instructions . '</span>';
                    $html_src .= '</p>';
                    $html_src .= '<div class="scf-radio-wrap">';
                    $html_src .= $this->getChoicesOfRadio($options->selectchoices, $the_meta, ['field_type' => $field_item->field_type, 'slug' => $field_item->slug]);
                    $html_src .= '</div>';
                    $html_src .= '</div>';
                }
                break;
            case 'repeater':{
                    $html_src .= '<div class="meta-box repeater-box" data-slug="' . $field_item->slug . '">';
                    $html_src .= '<p>';
                    $html_src .= '<label class="sbold">' . $field_item->title . '</label><br>';
                    $html_src .= '<span class="font-size-13">' . $field_item->instructions . '</span>';
                    $html_src .= '</p>';
                    $html_src .= '<div class="scf-repeater-wrap">';

                    $options = json_decode($field_item->options);
                    $repeater_items = $this->get_repeater_items($field_item->field_group_id, $field_item->id);
                    $the_meta_obj = json_decode($the_meta);

                    $html_src .= '<textarea class="scf-repeater-items form-control dis-none" style="display: none !important;" value="" rows="10">' . json_encode($repeater_items) . '</textarea>';
                    $html_src .= '<ul class="sortable-wrapper" data-slug="' . $field_item->slug . '">';
                    if ($the_meta_obj): foreach ($the_meta_obj as $key => $row): $key_index = $key + 1;
                            $html_src .= '<li data-position="' . $key_index . '">';
                            $html_src .= '<a href="#" class="remove-field-line"><i class="fa fa-minus"></i></a>';
                            $html_src .= '<div class="col-xs-12">';
                            $html_src .= '<ul class="sortable-wrapper disable-sortable" data-type="">';
                            $html_src .= $this->initRepeaterFieldLine($row, $repeater_items, $key_index);
                            $html_src .= '</ul>';
                            $html_src .= '</div>';
                            $html_src .= '<div class="clearfix"></div>';
                            $html_src .= '</li>';
                        endforeach;endif;
                    $html_src .= '</ul>';
                    $html_src .= '</div>';
                    $html_src .= '<div class="text-rig">';

                    $btn_label = $options->buttonlabel;
                    if ((trim($btn_label) == '')) {
                        $btn_label = 'Add new';
                    }
                    $html_src .= '<a href="#" class="repeater-add-new-field btn btn-success">' . $btn_label . '</a>';
                    $html_src .= '</div>';
                    $html_src .= '</div>';
                }
                break;
            default:{
                    return '';
                }
                break;
        }
        return $html_src;
    }

    public function getChoicesOfSelect($choicesString, $selectedChoice)
    {
        $result = '<option value=""></option>';
        $choices = preg_split('/\r\n|[\r\n]/', $choicesString);

        foreach ($choices as $key => $row) {
            $currentArr = explode(': ', $row);
            $result .= '<option ' . (($currentArr[0] == $selectedChoice) ? 'selected="selected"' : '') . ' value="' . $currentArr[0] . '">' . $currentArr[1] . '</option>';
        }
        return $result;
    }

    public function getChoicesOfCheckbox($choicesString, $selectedChoice, $other)
    {
        $result = '';
        $selectedChoice = json_decode($selectedChoice);
        if (!$selectedChoice) {
            $selectedChoice = [];
        }

        $choices = preg_split('/\r\n|[\r\n]/', $choicesString);
        if (!array_key_exists('current', $other)) {
            $other['current'] = 0;
        }

        foreach ($choices as $key => $row) {
            $currentArr = explode(': ', $row);
            $result .= '<span class="dis-block"><label><input type="checkbox" data-fieldtype="' . $other['field_type'] . '" data-slug="' . $other['slug'] . '" ' . ((in_array($currentArr[0], $selectedChoice)) ? 'checked="checked"' : '') . ' value="' . $currentArr[0] . '"> ' . $currentArr[1] . '</label></span>';
        }
        return $result;
    }

    public function getChoicesOfRadio($choicesString, $selectedChoice, $other)
    {
        $result = '';
        $choices = preg_split('/\r\n|[\r\n]/', $choicesString);
        if (!array_key_exists('current', $other)) {
            $other['current'] = 0;
        }

        foreach ($choices as $key => $row) {
            $currentArr = explode(': ', $row);
            $result .= '<span class="dis-block"><label><input type="radio" data-fieldtype="' . $other['field_type'] . '" data-slug="' . $other['slug'] . '" ' . (($currentArr[0] == $selectedChoice) ? 'checked="" selected' : '') . ' value="' . $currentArr[0] . '" name="custom-fields-' . $other['slug'] . $other['current'] . '"> ' . $currentArr[1] . '</label></span>';
        }
        return $result;
    }

    public function get_repeater_items($group_id, $parent_id = 0)
    {
        $node_groups = $this->getGroupNodes($group_id, $parent_id);
        $result = array();
        foreach ($node_groups as $key => $row) {
            $item = new \stdClass();
            $item->slug = $row->slug;
            $item->title = $row->title;
            $item->field_type = $row->field_type;
            $item->instructions = $row->instructions;
            $item->options = json_decode($row->options);
            array_push($result, $item);
        }
        return $result;
    }

    public function initRepeaterFieldLine($items, $repeater_field, $current = 0)
    {
        $html_src = '';
        $size_of_repeater = sizeof($repeater_field);
        $size_of_items = sizeof($items);
        $current_numb = 0;

        // echo '<pre>';
        // var_dump($items); exit();

        foreach ($items as $key => $row) {
            if ($size_of_repeater < $size_of_items && $key >= $size_of_items - 1) {
                break;
            }

            $currentKey = 0;
            foreach ($items as $key2 => $row2) {
                if (property_exists($row2, 'slug')) {
                    if ($repeater_field[$key]->slug == $row2->slug) {
                        $currentKey = $key2;
                    }
                }
            }

            $html_src .= '<li data-position="' . ($key + 1) . '">';
            $html_src .= '<div class="col-xs-3">';
            $html_src .= '<span class="field-label">' . $repeater_field[$key]->title . '</span>';
            $html_src .= '<br>';
            $html_src .= '<span class="field-instructions">' . $repeater_field[$key]->instructions . '</span>';
            $html_src .= '</div>';
            $html_src .= '<div class="col-xs-9">';

            $subField = new \stdClass();
            $subField->field_type = $row->field_type;
            $subField->field_value = $items[$currentKey]->field_value;
            $subField->slug = $items[$currentKey]->slug;
            $subField->field_type_updated = $repeater_field[$currentKey]->field_type;

            $options = $repeater_field[$key]->options;
            $html_src .= $this->initRepeaterInputItem($subField, $options, $current);

            $html_src .= '</div>';
            $html_src .= '<div class="clearfix"></div>';
            $html_src .= '</li>';
            $current_numb++;
        }
        if ($size_of_repeater > $size_of_items) {
            $offset = $size_of_items;
            for ($i = $offset; $i < $size_of_repeater; $i++) {
                $currentKey = 0;
                foreach ($items as $key2 => $row2) {
                    if ($repeater_field[$key]->slug == $row2->slug) {
                        $currentKey = $key2;
                    }
                }

                $html_src .= '<li data-position="' . ($i + 1) . '">';
                $html_src .= '<div class="col-xs-3">';
                $html_src .= '<span class="field-label">' . $repeater_field[$i]->title . '</span>';
                $html_src .= '<br>';
                $html_src .= '<span class="field-instructions">' . $repeater_field[$i]->instructions . '</span>';
                $html_src .= '</div>';
                $html_src .= '<div class="col-xs-9">';

                $new_field = new \stdClass();
                $new_field->field_value = '';
                $new_field->field_type = $repeater_field[$i]->field_type;
                $new_field->slug = $repeater_field[$i]->slug;
                $new_field->field_type_updated = $repeater_field[$i]->field_type;
                $options = $repeater_field[$i]->options;
                $html_src .= $this->initRepeaterInputItem($new_field, $options, $current);

                $html_src .= '</div>';
                $html_src .= '<div class="clearfix"></div>';
                $html_src .= '</li>';
                $offset++;
            }
        }
        return $html_src;
    }

    public function initRepeaterInputItem($sub_field, $options, $current = 0)
    {
        $html_src = '';
        $selected = (($sub_field->field_value) ? $sub_field->field_value : $options->defaultvalue);
        switch ($sub_field->field_type_updated) {
            case 'text':{
                    $html_src .= '<div class="scf-text-wrap">';
                    $html_src .= '<input type="text" data-fieldtype="' . $sub_field->field_type_updated . '" value="' . $sub_field->field_value . '" data-slug="' . $sub_field->slug . '" placeholder="' . $options->placeholdertext . '" class="form-control">';
                    $html_src .= '</div>';
                }
                break;
            case 'textarea':{
                    $html_src .= '<div class="scf-textarea-wrap">';
                    $html_src .= '<textarea rows="3"  data-fieldtype="' . $sub_field->field_type_updated . '" data-slug="' . $sub_field->slug . '" placeholder="' . $options->placeholdertext . '" class="form-control">' . $sub_field->field_value . '</textarea>';
                    $html_src .= '</div>';
                }
                break;
            case 'number':{
                    $html_src .= 'c<div class="scf-number-wrap">';
                    $html_src .= '<input type="number" data-fieldtype="' . $sub_field->field_type_updated . '" value="' . $sub_field->field_value . '" data-slug="' . $sub_field->slug . '" placeholder="' . $options->placeholdertext . '" class="form-control">';
                    $html_src .= '</div>';
                }
                break;
            case 'email':{
                    $html_src .= '<div class="scf-email-wrap">';
                    $html_src .= '<input type="email" data-fieldtype="' . $sub_field->field_type_updated . '" value="' . $sub_field->field_value . '" data-slug="' . $sub_field->slug . '" placeholder="' . $options->placeholdertext . '" class="form-control">';
                    $html_src .= '</div>';
                }
                break;
            case 'password':{
                    $html_src .= '<div class="scf-password-wrap">';
                    $html_src .= '<input type="password" data-fieldtype="' . $sub_field->field_type_updated . '" value="' . $sub_field->field_value . '" data-slug="' . $sub_field->slug . '" placeholder="' . $options->placeholdertext . '" class="form-control">';
                    $html_src .= '</div>';
                }
                break;
            case 'wyswyg':{
                    $toolbar = '';
                    if ($options->wyswygtoolbar == 'basic') {
                        $toolbar = 'toolbar: [[\'mode\', \'Source\', \'Image\', \'TextColor\', \'BGColor\', \'Styles\', \'Format\', \'Font\', \'FontSize\', \'CreateDiv\', \'PageBreak\', \'Bold\', \'Italic\', \'Underline\', \'Strike\', \'Subscript\', \'Superscript\', \'RemoveFormat\']], ';
                    }
                    $html_src .= '<div class="scf-wyswyg-wrap scf-textarea-wrap">';
                    $html_src .= '<script>';
                    $html_src .= '$(document).ready(function() {';
                    $html_src .= 'CKEDITOR.replace( "wyswyg_editor_field_' . $sub_field->slug . $current . '", {';
                    $html_src .= $toolbar;
                    $html_src .= '});});';
                    $html_src .= '</script>';
                    $html_src .= '<textarea rows="3" value="" data-fieldtype="' . $sub_field->field_type_updated . '" data-slug="' . $sub_field->slug . '" id="wyswyg_editor_field_' . $sub_field->slug . $current . '" placeholder="" class="form-control wyswyg-editor ckeditor">' . $sub_field->field_value . '</textarea>';
                    $html_src .= '</div>';
                }
                break;
            case 'image':{
                    $img_src = $sub_field->field_value;
                    if ((string) $img_src == '') {
                        $img_src = '/admin/images/no-image.png';
                    }
                    $html_src .= '<div class="scf-image-wrap">';
                    $html_src .= '<div class="select-media-box">';
                    $html_src .= '<a title="" class="btn blue show-add-media-popup">Choose image</a>';
                    $html_src .= '<div class="clearfix"></div>';
                    $html_src .= '<a title="" class="show-add-media-popup"><img src="' . asset($img_src) . '" alt="" class="img-responsive"></a>';
                    $html_src .= '<input type="hidden"" data-fieldtype="' . $sub_field->field_type_updated . '" data-slug="' . $sub_field->slug . '" value="' . $img_src . '" class="input-file">';
                    $html_src .= '<a href="#" title="" class="remove-image"><span>&nbsp;</span></a>';
                    $html_src .= '</div>';
                    $html_src .= '</div>';
                }
                break;
            case 'file':{
                    $file_src = $sub_field->field_value;
                    $img_src = '/admin/images/no-image.png';

                    $html_src .= '<div class="scf-file-wrap">';
                    $html_src .= '<div class="select-media-box select-file-box">';
                    $html_src .= '<a title="" class="btn blue show-add-media-popup select-file-box">Choose file</a>';
                    $html_src .= '<div class="clearfix"></div>';
                    $html_src .= '<a title="" class="show-add-media-popup select-file-box"><img src="' . asset($img_src) . '" alt="" class="img-responsive"><span class="title">' . $file_src . '</span></a>';
                    $html_src .= '<input type="hidden"" data-fieldtype="' . $sub_field->field_type_updated . '" data-slug="' . $sub_field->slug . '" value="' . $file_src . '" class="input-file">';
                    $html_src .= '<a href="#" title="" class="remove-image"><span>&nbsp;</span></a>';
                    $html_src .= '</div>';
                    $html_src .= '</div>';
                }
                break;
            case 'select':{
                    $html_src .= '<div class="scf-select-wrap">';
                    $html_src .= '<select name="" class="form-control" data-fieldtype="' . $sub_field->field_type_updated . '" data-slug="' . $sub_field->slug . '">';
                    $html_src .= $this->getChoicesOfSelect($options->selectchoices, $selected);
                    $html_src .= '</select>';
                    $html_src .= '</div>';
                }
                break;
            case 'checkbox':{
                    $selected = $sub_field->field_value;
                    if (!$selected) {
                        $selected = [];
                        $selected[] = $options->defaultvalue;
                        $selected = json_encode($selected);
                    }
                    $html_src .= '<div class="scf-checkbox-wrap">';
                    $html_src .= $this->getChoicesOfCheckbox($options->selectchoices, $selected, ['field_type' => $sub_field->field_type, 'slug' => $sub_field->slug]);
                    $html_src .= '</div>';
                }
                break;
            case 'radio':{
                    $html_src .= '<div class="scf-radio-wrap">';
                    $html_src .= $this->getChoicesOfRadio($options->selectchoices, $selected, ['field_type' => $sub_field->field_type, 'slug' => $sub_field->slug, 'current' => $current]);
                    $html_src .= '</div>';
                }
                break;
            case 'repeater':{
                    return $html_src;
                }
                break;
            default:{
                    return $html_src;
                }
                break;
        }
        return $html_src;
    }

    /*Check rules*/
    public function checkRules($args, $field_group)
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
                if ($this->checkEachRule($rule->field_options, $args) == true) {
                    $flag = true;
                }
            }
        }
        return $flag;
    }

    public function checkEachRule($rules, $args)
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
