$(window).load(function () {
    var $body = $('body');

    var number_js_added = 0;

    var repeater_field_html = $('#_repeater_template').html();

    // Show item's details
    $body.on('click', 'a.show-item-details', function (event) {
        event.preventDefault();
        var parent = $(this).closest('li');
        $(this).toggleClass('active');
        parent.toggleClass('active');
    });

    /*Edit fields*/
    // Get options
    var field_options = {
        repeater: $('#_options-repeater_template').html(),
        defaultvalue: $('#_options-defaultvalue_template').html(),
        defaultvaluetextarea: $('#_options-defaultvaluetextarea_template').html(),
        placeholdertext: $('#_options-placeholdertext_template').html(),
        wyswygtoolbar: $('#_options-wyswygtoolbar_template').html(),
        selectchoices: $('#_options-selectchoices_template').html(),
        buttonlabel: $('#_options-buttonlabel_template').html()
    };


    var get_options = function (the_value) {
        var html_src = '';
        switch (the_value) {
            case 'text':
            {
                html_src += field_options.defaultvalue + field_options.placeholdertext;
            }
                break;
            case 'textarea':
            {
                html_src += field_options.defaultvaluetextarea + field_options.placeholdertext;
            }
                break;
            case 'number':
            {
                html_src += field_options.defaultvaluetextarea + field_options.placeholdertext;
            }
                break;
            case 'wyswyg':
            {
                html_src += field_options.defaultvaluetextarea + field_options.placeholdertext + field_options.wyswygtoolbar;
            }
                break;
            case 'image':
            {
                return '';
            }
                break;
            case 'file':
            {
                return '';
            }
                break;
            case 'select':
            {
                html_src += field_options.selectchoices + field_options.defaultvalue;
            }
                break;
            case 'checkbox':
            {
                html_src += field_options.selectchoices + field_options.defaultvalue;
            }
                break;
            case 'radio':
            {
                html_src += field_options.selectchoices + field_options.defaultvalue;
            }
                break;
            case 'repeater':
            {
                html_src += field_options.repeater + field_options.buttonlabel;
            }
                break;
            case 'email':
            {
                return get_options('text');
            }
                break;
            case 'password':
            {
                return get_options('text');
            }
                break;
            default:
            {

            }
                break;
        }

        return html_src;
    };
    // Change fields type
    $body.on('change', '.change-field-type', function (event) {
        event.preventDefault();
        var current = $(this);
        var parent = current.parent().parent();
        var target = parent.find('~ .options');

        target.html(get_options(current.val()));
        App.initUniform();
    });
    /*Edit fields*/

    // Add fields
    function new_field_src(number_added, is_repeater) {
        var new_html_src = $('#_new-field-source_template').html();

        if(is_repeater) {
            new_html_src = new_html_src.replace('<optgroup label="Other"><option value="repeater">Repeater</option></optgroup>', '');
        }

        new_html_src = new_html_src.replace(/___options___/gi, get_options('text'));

        return new_html_src;
    }

    $body.on('click', '.btn-add-field', function (event) {
        event.preventDefault();
        var current = $(this), html_src = '';

        number_js_added++;

        var target = current.closest('.add-new-field').find('> .sortable-wrapper');
        if (current.attr('href') == 'repeater') {
            html_src = new_field_src(number_js_added, true);
        }
        else {
            html_src = new_field_src(number_js_added, false);
        }

        target.append(html_src);
        reload_order_numb(target.find('> li'));
        App.initUniform();
    });

    // Remove fields
    var deleted_items = [];
    $('#deleted_items').val('');
    $body.on('click', '.btn-remove', function (event) {
        event.preventDefault();
        var parent = $(this).closest('li');
        var parent_of_parent = parent.parent();
        deleted_items.push(parent.attr('data-id'));
        parent.animate({
                top: -60,
                left: 60,
                opacity: 0.3
            },
            300,
            function () {
                parent.remove();
                reload_order_numb(parent_of_parent.find('> li'));
                $('#deleted_items').val(window.JSON.stringify(deleted_items));
            });
    });

    // Close fields
    $body.on('click', '.btn-close-field', function (event) {
        event.preventDefault();
        var parent = $(this).closest('li');
        parent.removeClass('active');
        parent.find('a.show-item-details').removeClass('active');
    });

    // Change the default values
    $body.on('change', '.item-details > .line input, .item-details > .line select, .item-details > .line textarea', function (event) {
        event.preventDefault();
        var current_line = $(this).closest('.line');

        var dd_item = current_line.closest('li');
        dd_item.data(current_line.attr('data-option'), $(this).val());
        dd_item.attr('data-' + current_line.attr('data-option'), $(this).val());

        // Change text
        dd_item.find('> .field-column .field-label').html(dd_item.find('> .item-details > [data-option="title"] input').val());
        dd_item.find('> .field-column .field-name').html(dd_item.find('> .item-details > [data-option="name"] input').val());
        dd_item.find('> .field-column .field-type').html(dd_item.find('> .item-details > [data-option="type"] select').val());
    });

    /*Handle rules*/
    // Change rule lines
    $body.on('change', '.rule-line select.rule-a', function (event) {
        event.preventDefault();
        var current = $(this);
        var parent = current.closest('.rule-line');
        parent.find('.rules-b-group select').addClass('hidden');
        parent.find('.rules-b-group select[data-rel="' + current.val() + '"]').removeClass('hidden');
    });
    // Trigger change when page loaded
    $('.rule-line select.rule-a').trigger('change');

    // Add new rule
    $body.on('click', '.location-add-rule', function (event) {
        event.preventDefault();
        var html_src = '';
        var current = $(this);
        var parent = current.closest('.rule-line');
        if (current.hasClass('location-add-rule-and')) {
            html_src += '<div class="line rule-line rule-and">';
            html_src += parent.html();
            html_src += '</div>';
            parent.parent().append(html_src);
        }
        else {
            parent = current.parent().parent();
            html_src += '<div class="line-group or-group" data-text="Or" data-rel="or"><div class="line rule-line rule-and">';
            html_src += parent.find('> .line-group-container > .line-group > .rule-line:first-child').html();
            html_src += '</div></div>';
            $('.line-group-container').append(html_src);
        }
        $('.rule-line select.rule-a').trigger('change');
    });

    // Remove rule line
    $body.on('click', '.remove-rule-line', function (event) {
        event.preventDefault();
        var parent = $(this).closest('.rule-line');
        if (parent.parent().hasClass('and-group') != true) {
            var is_last = false;
            if (parent.parent().find('> .rule-line').length == 1) {
                is_last = true;
            }
            parent.animate({
                    opacity: 0.3
                },
                300, function () {
                    if (is_last) {
                        parent.parent().remove();
                    }
                    else {
                        parent.remove();
                    }
                });
        }
        else {
            if (parent.is(':first-child') != true) {
                parent.animate({
                        opacity: 0.3
                    },
                    300, function () {
                        parent.remove();
                    });
            }
        }
    });

    var the_rules = the_rules = jQuery.parseJSON($('#custom_fields_rules').val());

    /*Handle rules*/

    // Submit
    $body.on('click', 'button, .page-content-wrapper .page-content form [type="submit"]', function (event) {
        event.preventDefault();
        var current = $(this);
        Utility.showLoading();
        init_options();
        $('#nestable-output').val(JSON.stringify(my_custom_json_output($('.nestable-group > .add-new-field > .sortable-wrapper > li'), true)));
        get_rules_json();

        // setTimeout(function() {
        current.closest('form').submit();
        // }, 500);
    });
});

function get_rules_json() {
    var rules_json = [];
    $('.custom-fields-rules .line-group-container .line-group').each(function (index, el) {
        var current = $(this);
        var json_obj_1 = {};
        json_obj_1.field_relation = current.attr('data-rel');
        json_obj_1.field_options = [];
        var dom_value = current.find('.rules-b-group select:not(.hidden)');
        dom_value.each(function (index, el) {
            var current_2 = $(this);
            var json_obj_2 = {};
            json_obj_2.rel_name = current_2.attr('data-rel');
            json_obj_2.rel_value = current_2.val();
            json_obj_2.rel_type = current_2.closest('.rules-b-group').prev('.rule-type').val();
            json_obj_1.field_options.push(json_obj_2);
        });
        rules_json.push(json_obj_1);
    });
    $('#custom_fields_rules').html(JSON.stringify(rules_json));
    $('#custom_fields_rules').val(JSON.stringify(rules_json));
}

// Reload order
function reload_order_numb(target) {
    target.each(function (index, el) {
        var current = $(this);
        var index_css = index + 1;
        current.attr('data-position', index_css);
    });
}

// Custom json for repeater
function my_custom_json_output(target, find_child) {
    var json_obj = returned_json(target, find_child, false);
    return json_obj;
}
function returned_json(target, find_child, push_to) {
    var json_obj = [];
    target.each(function (index, el) {
        var current = $(this);
        var json_obj_item = {};
        json_obj_item.id = current.data('id');
        json_obj_item.instructions = current.data('instructions');
        json_obj_item.name = current.data('name');
        json_obj_item.options = current.data('options');
        json_obj_item.title = current.data('title');
        json_obj_item.type = current.data('type');

        var child_target = current.find('> .item-details > .options > div[data-option="repeater"] > .col-xs-9 > .add-new-field > .sortable-wrapper > li');

        // Find children
        if (find_child === true) {
            json_obj_item.repeateritems = [];

            if (child_target.length > 0) {
                var children_items = returned_json(child_target, true, json_obj_item.repeateritems);
                if (children_items != 0) {
                    json_obj_item.repeateritems.push(children_items);
                }
            }
        }

        // Push items to object
        if (typeof push_to === 'object') {
            push_to.push(json_obj_item);
        }
        else {
            json_obj.push(json_obj_item);
        }
    });
    if (typeof push_to === 'object') {
        return 0;
    }
    return json_obj;
}

// Function init options
function init_options() {
    // Init default
    var json = {
        'defaultvalue': '',
        'placeholdertext': '',
        'defaultvaluetextarea': '',
        'wyswygtoolbar': '',
        'selectchoices': '',
        'buttonlabel': '',
    };
    $('.sortable-wrapper > li').data('options', json);

    // Get options
    $('.item-details > .options input, .item-details > .options select, .item-details > .options textarea').each(function (index, el) {
        var options_list = $(this).closest('.options');
        var json = {
            'defaultvalue': '',
            'placeholdertext': '',
            'defaultvaluetextarea': '',
            'wyswygtoolbar': '',
            'selectchoices': '',
            'buttonlabel': '',
        };

        // Get values
        var defaultvalue = options_list.find(' > [data-option="defaultvalue"]');
        if (defaultvalue.length > 0) {
            json.defaultvalue = defaultvalue.find('input').val();
        }
        var placeholdertext = options_list.find(' > [data-option="placeholdertext"]');
        if (placeholdertext.length > 0) {
            json.placeholdertext = placeholdertext.find('input').val();
        }
        var defaultvaluetextarea = options_list.find(' > [data-option="defaultvaluetextarea"]');
        if (defaultvaluetextarea.length > 0) {
            json.defaultvaluetextarea = defaultvaluetextarea.find('textarea').val();
        }
        var wyswygtoolbar = options_list.find(' > [data-option="wyswygtoolbar"]');
        if (wyswygtoolbar.length > 0) {
            json.wyswygtoolbar = wyswygtoolbar.find('input[type="radio"]:checked').val();
        }
        var selectchoices = options_list.find(' > [data-option="selectchoices"]');
        if (selectchoices.length > 0) {
            json.selectchoices = selectchoices.find('textarea').val();
        }
        var buttonlabel = options_list.find(' > [data-option="buttonlabel"]');
        if (buttonlabel.length > 0) {
            json.buttonlabel = buttonlabel.find('input').val();
        }
        // Get values

        var dd_item = options_list.closest('li');
        dd_item.data('options', json);
        dd_item.attr('data-options', JSON.stringify(json));
    });
}