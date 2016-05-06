var Utility = function () {
    var $body = $('body'),
        $window = $(window);
    /*Detect IE*/
    var detectIE = function (callback) {
        isIE8 = !!navigator.userAgent.match(/MSIE 8.0/);
        isIE9 = !!navigator.userAgent.match(/MSIE 9.0/);
        isIE10 = !!navigator.userAgent.match(/MSIE 10.0/);
        isIE11 = !!navigator.userAgent.match(/rv:11.0/);

        if (isIE10) {
            $('html').addClass('ie10'); // detect IE10 version
        }

        if (isIE11) {
            $('html').addClass('ie11'); // detect IE11 version
        }

        if (isIE11 || isIE10 || isIE9 || isIE8) {
            $('html').addClass('ie'); // detect IE version
            if (typeof callback != 'undefined') callback();
        }
    };

    /*Scroll to top*/
    var scrollToTop = function (event) {
        if (event) event.preventDefault();
        $('html, body').stop().animate({
            scrollTop: 0
        }, 800);
    };

    /*Handle scroll to top*/
    var handleScroll = function () {
        $body.on('click', '[data-toggle="scroll-to-top"]', function (event) {
            event.preventDefault();
            scrollToTop();
        });
        $window.trigger('scroll');
    };

    var stringToSlug = function (text) {
        return text.toString().toLowerCase()
            .replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a')
            .replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e')
            .replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i')
            .replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o')
            .replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u')
            .replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y')
            .replace(/đ/gi, 'd')
            .replace(/\s+/g, '-')           // Replace spaces with -
            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
            .replace(/\-\-+/g, '-')         // Replace multiple - with single -
            .replace(/^-+/, '')             // Trim - from start of text
            .replace(/-+$/, '');            // Trim - from end of text
    };

    /*Show notifications*/
    /*Notific8 plugin*/
    function showNotification8($message, $type) {
        switch ($type) {
            case 'success':
            {
                $type = 'lime';
            }
                break;
            case 'info':
            {
                $type = 'teal';
            }
                break;
            case 'warning':
            {
                $type = 'tangerine';
            }
                break;
            case 'danger':
            {
                $type = 'ruby';
            }
                break;
            case 'error':
            {
                $type = 'ruby';
            }
                break;
            default:
            {
                $type = 'ebony';
            }
                break;
        }
        $.notific8('zindex', 11500);

        var settings = {
            theme: $type,
            sticky: false,
            horizontalEdge: 'top',
            verticalEdge: 'right'
        };

        if ($message instanceof Array) {
            $message.forEach(function (value) {
                $.notific8($.trim(value), settings);
            });
        }
        else {
            $.notific8($.trim($message), settings);
        }
    }

    return {
        detectIE: function (callback) {
            detectIE(callback);
        },
        showLoading: function () {
            $body.addClass('on-loading');
        },
        hideLoading: function () {
            $body.removeClass('on-loading');
        },
        handleScroll: function () {
            handleScroll();
        },
        scrollToTop: function (event) {
            scrollToTop(event);
        },
        showNotification: function ($message, $type) {
            showNotification8($message, $type);
        },
        stringToSlug: function (text) {
            return stringToSlug(text);
        },
        convertTitleToSlug: function ($titleSelector, $slugSelector) {
            $body.on('blur', $titleSelector, function (event) {
                if (!$($slugSelector).val()) {
                    $($slugSelector).val(stringToSlug($($titleSelector).val()));
                }
            });
        },
        changeContentLanguage: function () {
            $body.on('change', '.js-change-content-language', function (event) {
                event.preventDefault();
                var current = $(this);
                location.href = current.attr('data-href') + current.val();
            });
        },
        handleSelectMediaBox: function () {
            $body.on('click', '.show-add-media-popup', function (event) {
                event.preventDefault();
                var $isFileBrowser = '';
                var fileType = 'image';

                document.currentMediaBox = $(this).closest('.select-media-box');
                document.mediaModal = $('#select_media_modal');

                if ($(this).hasClass('select-file-box')) {
                    $isFileBrowser = '&type=file';
                    fileType = 'file';
                }
                if (fileType == 'file') {
                    document.mediaModal.find('.nav-tabs .external-image').hide();
                    document.mediaModal.find('.nav-tabs .external-file').show();
                }
                else {
                    document.mediaModal.find('.nav-tabs .external-image').show();
                    document.mediaModal.find('.nav-tabs .external-file').hide();
                }

                $('#select_media_modal .modal-body .iframe-container').html('<iframe src="' + fileManagerUrl + '?method=standalone' + $isFileBrowser + '"></iframe>');
                document.mediaModal.modal();
            });
            $body.on('click', '.select-media-box .remove-image', function (event) {
                event.preventDefault();
                document.currentMediaBox = $(this).closest('.select-media-box');
                $imageSrc = '/admin/images/no-image.png';
                document.currentMediaBox.find('img.img-responsive').attr('src', $imageSrc);
                document.currentMediaBox.find('.input-file').val('');
            });
            $body.on('click', '.select-media-modal-external-asset .btn', function (event) {
                event.preventDefault();
                var $current = $(this);
                var $textField = $current.closest('.select-media-modal-external-asset').find('.input-asset');
                var URL = $textField.val();
                var fileType = ($current.closest('.select-media-modal-external-asset').attr('id') == 'select_media_modal_external_file') ? 'file' : 'image';

                var $modal = document.mediaModal;
                var $target = document.currentMediaBox;
                if (fileType == 'file') {
                    $target.find('a .title').html(URL);
                }
                else {
                    $target.find('.img-responsive').attr('src', URL);
                }

                $target.find('.input-file').val(URL);
                $modal.find('iframe').remove();
                $modal.modal('hide');
                $textField.val('');
            });
        },
        handleCustomFields: function () {
            var added_nodes = 0;
            /*Custom fields - 20150228 - Duy Phan*/
            // Add new field in repeater
            $('body').on('click', '.repeater-add-new-field', function (event) {
                event.preventDefault();
                added_nodes++;
                var parent = $(this).closest('.meta-box').find('> .scf-repeater-wrap');
                var field_nodes = parent.find('> .scf-repeater-items').val();
                field_nodes = $.parseJSON(field_nodes);
                var add_to = parent.find('> .sortable-wrapper');
                var current_index = add_to.find('> li').length + 1;
                var html_src = '<li data-position="' + current_index + '"><a href="#" class="remove-field-line"><i class="fa fa-minus"></i></a><div class="col-xs-12"><ul class="sortable-wrapper disable-sortable">';
                $.each(field_nodes, function (index, val) {
                    var index_css = index + 1;
                    var current = this;
                    var field_type = current.field_type;
                    var slug = current.slug;
                    var title = current.title;
                    html_src += '<li data-position="' + index_css + '"><div class="col-xs-3"><span class="field-label">' + title + '</span><br><span class="field-instructions">' + current.instructions + '</span></div><div class="col-xs-9">';
                    html_src += get_repeater_line(slug, field_type, title, current.instructions, current.options);
                    html_src += '</div><div class="clearfix"></div></li>';
                });
                html_src += '</ul></div><div class="clearfix"></div></li>';
                add_to.append(html_src);
                App.initUniform();
                $('input[type="radio"][checked]').trigger('click');
            });

            // Submit
            $('body').on('click', '.page-content-wrapper .page-content form [type="submit"]', function (event) {
                //event.preventDefault();
                create_json_scf();
            });

            // Remove field line
            $('body').on('click', '.remove-field-line', function (event) {
                event.preventDefault();
                var current = $(this);
                current.parent().animate({
                        opacity: 0.1,
                    },
                    300, function () {
                        current.parent().remove();
                    });
            });

            /*Re-init CKeditor when start/stop sort*/
            $('body').on('sortstart', '.sortable-wrapper', function (event, ui) {
                ui.item.find('.scf-wyswyg-wrap > textarea').each(function (index, el) {
                    var current_2 = $(this);
                    var the_id = current_2.attr('id');
                    if (the_id != '') {
                        eval('CKEDITOR.instances.' + current_2.attr('id') + '.destroy();');
                    }
                });
            });
            $('body').on('sortstop', '.sortable-wrapper', function (event, ui) {
                ui.item.find('.scf-wyswyg-wrap > textarea').each(function (index, el) {
                    var current_2 = $(this);
                    var the_id = current_2.attr('id');
                    if (the_id != '') {
                        var html_src = '';
                        html_src += 'CKEDITOR.replace( "' + the_id + '", {';
                        html_src += 'toolbar: [[\'mode\', \'Source\', \'Image\', \'TextColor\', \'BGColor\', \'Styles\', \'Format\', \'Font\', \'FontSize\', \'CreateDiv\', \'PageBreak\', \'Bold\', \'Italic\', \'Underline\', \'Strike\', \'Subscript\', \'Superscript\', \'RemoveFormat\']], filebrowserBrowseUrl : "' + baseUrl + '/resources/assets/global/plugins/ckeditor/plugins/pdw_file_browser/?editor=ckeditor"';
                        html_src += '});';
                        eval(html_src);
                    }
                });
            });
            /*Custom fields - 20150228 - Duy Phan*/
            function get_repeater_line(slug, field_type, title, instructions, options) {
                html_src = '';
                switch (field_type) {
                    case 'text':
                    {
                        html_src += '<div class="scf-text-wrap"><input type="text" class="form-control" data-fieldtype="' + field_type + '" data-slug="' + slug + '" placeholder="' + options.placeholdertext + '" value=""></div>';
                    }
                        break;
                    case 'textarea':
                    {
                        html_src += '<div class="scf-textarea-wrap"><textarea rows="3" value="" data-fieldtype="' + field_type + '" data-slug="' + slug + '" placeholder="' + options.placeholdertext + '" class="form-control wyswyg-editor"></textarea></div>';
                    }
                        break;
                    case 'number':
                    {
                        html_src += '<div class="scf-text-wrap"><input type="number" class="form-control" data-fieldtype="' + field_type + '" data-slug="' + slug + '" placeholder="' + options.placeholdertext + '" value=""></div>';
                    }
                        break;
                    case 'email':
                    {
                        html_src += '<div class="scf-text-wrap"><input type="email" class="form-control" data-fieldtype="' + field_type + '" data-slug="' + slug + '" placeholder="' + options.placeholdertext + '" value=""></div>';
                    }
                        break;
                    case 'password':
                    {
                        html_src += '<div class="scf-text-wrap"><input type="password" class="form-control" data-fieldtype="' + field_type + '" data-slug="' + slug + '" placeholder="' + options.placeholdertext + '" value=""></div>';
                    }
                        break;
                    case 'wyswyg':
                    {
                        if (options.wyswygtoolbar == 'basic') {
                            html_src += '<div class="scf-wyswyg-wrap scf-textarea-wrap"><script>$(document).ready(function() {CKEDITOR.replace( "wyswyg_editor_slug' + slug + '_' + added_nodes + '", {toolbar: [[\'mode\', \'Source\', \'Image\', \'TextColor\', \'BGColor\', \'Styles\', \'Format\', \'Font\', \'FontSize\', \'CreateDiv\', \'PageBreak\', \'Bold\', \'Italic\', \'Underline\', \'Strike\', \'Subscript\', \'Superscript\', \'RemoveFormat\']]});});</script><textarea rows="3" value="" id="wyswyg_editor_slug' + slug + '_' + added_nodes + '" data-fieldtype="' + field_type + '" data-slug="' + slug + '" placeholder="' + options.placeholdertext + '" class="form-control wyswyg-editor"></textarea></div>';
                        }
                        else {
                            html_src += '<div class="scf-wyswyg-wrap scf-textarea-wrap"><script>$(document).ready(function() {CKEDITOR.replace( "wyswyg_editor_slug' + slug + '_' + added_nodes + '", {});});</script><textarea rows="3" value="" id="wyswyg_editor_slug' + slug + '_' + added_nodes + '" data-fieldtype="' + field_type + '" data-slug="' + slug + '" placeholder="' + options.placeholdertext + '" class="form-control wyswyg-editor"></textarea></div>';
                        }
                    }
                        break;
                    case 'image':
                    {
                        html_src += '<div class="scf-image-wrap">';
                        html_src += '<div class="select-media-box">';
                        html_src += '<a title="" class="btn blue show-add-media-popup">Choose image</a>';
                        html_src += '<div class="clearfix"></div>';
                        html_src += '<a title="" class="show-add-media-popup"><img src="/admin/images/no-image.png" alt="" class="img-responsive"></a>';
                        html_src += '<input type="hidden" data-fieldtype="' + field_type + '" data-slug="' + slug + '" value="" class="input-file">';
                        html_src += '<a href="#" title="" class="remove-image"><span>&nbsp;</span></a>';
                        html_src += '</div></div>';
                    }
                        break;
                    case 'file':
                    {
                        html_src += '<div class="scf-file-wrap">';
                        html_src += '<div class="select-media-box select-file-box">';
                        html_src += '<a title="" class="btn blue show-add-media-popup select-file-box">Choose file</a>';
                        html_src += '<div class="clearfix"></div>';
                        html_src += '<a title="" class="show-add-media-popup select-file-box"><img src="/admin/images/no-image.png" alt="" class="img-responsive"><span class="title">File name</span></a>';
                        html_src += '<input type="hidden" data-fieldtype="' + field_type + '" data-slug="' + slug + '" value="" class="input-file">';
                        html_src += '<a href="#" title="" class="remove-image"><span>&nbsp;</span></a>';
                        html_src += '</div></div>';
                    }
                        break;
                    case 'select':
                    {
                        html_src += '<div class="scf-select-wrap">';
                        html_src += '<select class="form-control" data-fieldtype="' + field_type + '" data-slug="' + slug + '">';
                        html_src += getChoicesOfSelect(options.selectchoices, options.defaultvalue);
                        html_src += '</select>';
                        html_src += '</div>';
                    }
                        break;
                    case 'checkbox':
                    {
                        html_src += '<div class="scf-checkbox-wrap">';
                        html_src += getChoicesOfCheckbox(options.selectchoices, options.defaultvalue, [field_type, slug]);
                        html_src += '</div>';
                    }
                        break;
                    case 'radio':
                    {
                        html_src += '<div class="scf-radio-wrap">';
                        html_src += getChoicesOfRadio(options.selectchoices, options.defaultvalue, [field_type, slug]);
                        html_src += '</div>';
                    }
                        break;
                    case 'repeater':
                    {

                    }
                        break;
                    default:
                    {

                    }
                        break;
                }
                ;
                return html_src;
            }

            function getChoicesOfSelect($choicesString, $selectedChoice) {
                $result = '<option value=""></option>';
                $choices = $choicesString.split('\n');

                $.each($choices, function ($key, $row) {
                    $currentArr = $row.split(': ');
                    $result += '<option ' + (($currentArr[0] == $selectedChoice) ? 'selected="selected"' : '') + ' value="' + $currentArr[0] + '">' + $currentArr[1] + '</option>';
                });
                return $result;
            }

            function getChoicesOfCheckbox($choicesString, $selectedChoice, $other) {
                $result = '';
                $selectedChoice = $.parseJSON($selectedChoice);
                if (!$selectedChoice) $selectedChoice = [];
                $choices = $choicesString.split('\n');

                $.each($choices, function ($key, $row) {
                    $currentArr = $row.split(': ');
                    $result += '<span class="dis-block"><label><input type="checkbox" data-fieldtype="' + $other[0] + '" data-slug="' + $other[1] + '" value="' + $currentArr[0] + '" name="custom-fields-' + $other[1] + '-' + added_nodes + '"> ' + $currentArr[1] + '</label></span>';
                });
                return $result;
            }

            function getChoicesOfRadio($choicesString, $selectedChoice, $other) {
                $result = '';
                $choices = $choicesString.split('\n');

                $.each($choices, function ($key, $row) {
                    $currentArr = $row.split(': ');
                    $result += '<span class="dis-block"><label><input type="radio" data-fieldtype="' + $other[0] + '" data-slug="' + $other[1] + '" ' + (($currentArr[0] == $selectedChoice) ? 'checked="checked"' : '') + ' value="' + $currentArr[0] + '" name="custom-fields-' + $other[1] + '"> ' + $currentArr[1] + '</label></span>';
                });
                return $result;
            }

            /*Create custom fields - json*/
            function create_json_scf() {
                var data_return = [];
                // Get data from input field (type equal to text, email, password, phone)
                $('.meta-box.normal-box').each(function (index, el) {
                    var current = $(this);
                    var each_scf = {};
                    each_scf.field_items = [];
                    each_scf.field_slug = current.attr('data-slug');
                    each_scf.field_value = current.find('input:first').val();
                    data_return.push(each_scf);
                });
                // Get data from textarea field
                $('.meta-box.textarea-box').each(function (index, el) {
                    var current = $(this);
                    var each_scf = {};
                    var textarea_target = current.find('> .scf-textarea-wrap > textarea');
                    var editorText = '';
                    if (textarea_target.attr('id') != '' && textarea_target.attr('id') != null) {
                        editorText = eval('CKEDITOR.instances.' + textarea_target.attr('id') + '.getData()');
                    }
                    else {
                        editorText = textarea_target.val();
                    }
                    each_scf.field_items = [];
                    each_scf.field_slug = current.attr('data-slug');
                    each_scf.field_value = editorText;
                    data_return.push(each_scf);
                });
                // Get data from select box
                $('.meta-box.select-box').each(function (index, el) {
                    var current = $(this);
                    var each_scf = {};
                    each_scf.field_items = [];
                    each_scf.field_slug = current.attr('data-slug');
                    each_scf.field_value = current.find('select').val();
                    data_return.push(each_scf);
                });
                // Get data from check box
                $('.meta-box.check-box').each(function (index, el) {
                    var current = $(this);
                    var each_scf = {};
                    each_scf.field_items = [];
                    each_scf.field_slug = current.attr('data-slug');
                    // Get multi data
                    var checkbox_field = [];
                    current.find('input[type="checkbox"]:checked').each(function (index, el) {
                        checkbox_field.push($(this).val());
                    });
                    each_scf.field_value = JSON.stringify(checkbox_field);
                    data_return.push(each_scf);
                });
                // Get data from select box
                $('.meta-box.radio-box').each(function (index, el) {
                    var current = $(this);
                    var each_scf = {};
                    each_scf.field_items = [];
                    each_scf.field_slug = current.attr('data-slug');
                    each_scf.field_value = current.find('input[type="radio"]:checked').val();
                    data_return.push(each_scf);
                });
                create_json_repeater($('.repeater-box > .scf-repeater-wrap > .sortable-wrapper'), data_return);
                // console.log(data_return);
            }

            /*Add repeater*/
            function create_json_repeater(find_from, update_to) {
                find_from.each(function (index, el) {
                    var current = $(this);
                    var each_repeater = {};
                    each_repeater.field_slug = current.attr('data-slug');
                    each_repeater.field_items = [];
                    current.find('> li').each(function (index, el) {
                        var current_2 = $(this);
                        var item_arr = [];
                        current_2.find(' > .col-xs-12 > .sortable-wrapper.disable-sortable > li').each(function (index, el) {
                            // var val_str = 'item_obj.' + $(this).find('input:first').attr('data-slug') + ' = "' + $(this).find('input:first').val() + '";';
                            // eval(val_str);
                            var child_obj = {};
                            var current_3 = $(this);
                            var the_input = current_3.find('input:not([type="checkbox"], [type="radio"])');

                            child_obj.field_value = the_input.val();

                            if (the_input.length < 1) {
                                // No input found, find textarea instead
                                the_input = current_3.find('.scf-textarea-wrap > textarea');

                                if (the_input.length < 1) {
                                    // No input found, find select instead
                                    the_input = current_3.find('.scf-select-wrap > select');

                                    if (the_input.length < 1) {
                                        // No select found, find radio instead
                                        the_input = current_3.find('.scf-radio-wrap input[type="radio"]:checked');

                                        // No radio found, find checkbox instead
                                        if (the_input.length < 1) {
                                            the_input = current_3.find('.scf-checkbox-wrap input[type="checkbox"]:checked');
                                        }
                                    }

                                    if (the_input.length > 1) {
                                        var $arr = [];
                                        the_input.each(function (index, el) {
                                            $arr.push($(this).val());
                                        });
                                        child_obj.field_value = JSON.stringify($arr);
                                    }
                                    else if (the_input.length > 0) {
                                        child_obj.field_value = the_input.val();
                                    }
                                    else {
                                        child_obj.field_value = '';
                                    }

                                }
                                else {
                                    var editorText = '';
                                    if (the_input.attr('id') != '' && the_input.attr('id') != null) {
                                        editorText = eval('CKEDITOR.instances.' + the_input.attr('id') + '.getData()');
                                    }
                                    else {
                                        editorText = the_input.val();
                                    }
                                    child_obj.field_value = editorText;
                                }
                            }

                            if (the_input.length > 1) {
                                console.log(the_input);
                            }

                            child_obj.field_type = the_input.attr('data-fieldtype');
                            child_obj.slug = the_input.attr('data-slug');
                            item_arr.push(child_obj);
                        });
                        each_repeater.field_items.push(item_arr);
                    });
                    update_to.push(each_repeater);
                });
                $('#custom_fields_container').val('').html('');
                $('#custom_fields_container').val(JSON.stringify(update_to));
                $('#custom_fields_container').html(JSON.stringify(update_to));
            }
        }
    };
}();