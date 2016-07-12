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

    var stringToSlug = function (text, separator) {
        separator = separator || '-';
        return text.toString().toLowerCase()
            .replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a')
            .replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e')
            .replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i')
            .replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o')
            .replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u')
            .replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y')
            .replace(/đ/gi, 'd')
            .replace(/\s+/g, separator)           // Replace spaces with -
            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
            .replace(/\-\-+/g, separator)         // Replace multiple - with single -
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
            var addedNodes = 0;

            var customFieldTemplates = {
                repeater: $('#_repeater_template').html(),
                repeaterFieldLine: $('#_repeater-field-line_template').html(),
                repeaterTextArea: $('#_repeater-textarea_template').html(),
                repeaterText: $('#_repeater-text_template').html(),
                repeaterNumber: $('#_repeater-number_template').html(),
                repeaterEmail: $('#_repeater-email_template').html(),
                repeaterPassword: $('#_repeater-password_template').html(),
                repeaterImage: $('#_repeater-image_template').html(),
                repeaterFile: $('#_repeater-file_template').html(),
                repeaterSelect: $('#_repeater-select_template').html(),
                repeaterSelectChoices: $('#_repeater-select-choices_template').html(),
                repeaterCheckbox: $('#_repeater-checkbox_template').html(),
                repeaterCheckboxChoices: $('#_repeater-checkbox-choices_template').html(),
                repeaterRadio: $('#_repeater-radio_template').html(),
                repeaterRadioChoices: $('#_repeater-radio-choices_template').html(),
                repeaterWyswyg: $('#_repeater-wyswyg_template').html()
            };

            // Add new field in repeater
            $('body').on('click', '.repeater-add-new-field', function (event) {
                event.preventDefault();
                addedNodes++;
                var parent = $(this).closest('.meta-box').find('> .scf-repeater-wrap');
                var fieldNodes = $.parseJSON(parent.find('> .scf-repeater-items').val());

                var addTo = parent.find('> .sortable-wrapper');
                var currentIndex = addTo.find('> li').length + 1;
                var htmlSrc = customFieldTemplates.repeater.replace(/___keyIndex___/gi, currentIndex || 0);
                var childHtml = '';

                $.each(fieldNodes, function (index, val) {
                    var indexCSS = index + 1;
                    var current = this;
                    var fieldType = current.field_type;
                    var slug = current.slug;
                    var title = current.title;
                    var instructions = current.instructions;
                    var options = current.options;

                    childHtml += customFieldTemplates.repeaterFieldLine
                        .replace(/___key___/gi, indexCSS || 0)
                        .replace(/___title___/gi, title || '')
                        .replace(/___instructions___/gi, instructions || '')
                        .replace(/___repeaterInputItem___/gi, _getRepeaterFieldLine(slug, fieldType, title, instructions, options));
                });
                htmlSrc = htmlSrc.replace(/___repeaterFieldLine___/gi, childHtml);

                addTo.append(htmlSrc);
                App.initUniform();
                $('input[type="radio"][checked]').trigger('click');
            });

            // Submit
            $('body').on('click', '.page-content-wrapper .page-content form [type="submit"]', function (event) {
                //event.preventDefault();
                initializeJsonCustomFields();
            });

            // Remove field line
            $('body').on('click', '.remove-field-line', function (event) {
                event.preventDefault();
                var current = $(this);
                current.parent().animate({
                        opacity: 0.1
                    },
                    300, function () {
                        current.parent().remove();
                    });
            });

            //Collapse line
            $('body').on('click', '.collapse-field-line', function (event) {
                event.preventDefault();
                var current = $(this);
                current.toggleClass('collapsed-line');
            });

            /*Custom fields - 20150228 - Duy Phan*/
            function _getRepeaterFieldLine(slug, fieldType, title, instructions, options) {
                var htmlSrc = '';
                switch (fieldType) {
                    case 'text':
                    {
                        htmlSrc += customFieldTemplates.repeaterText
                            .replace(/___fieldType___/gi, fieldType)
                            .replace(/___slug___/gi, slug)
                            .replace(/___value___/gi, options.defaultvalue)
                            .replace(/___placeholder___/gi, options.placeholdertext);
                    }
                        break;
                    case 'textarea':
                    {
                        htmlSrc += customFieldTemplates.repeaterTextArea
                            .replace(/___fieldType___/gi, fieldType)
                            .replace(/___slug___/gi, slug)
                            .replace(/___value___/gi, options.defaultvalue)
                            .replace(/___placeholder___/gi, options.placeholdertext);
                    }
                        break;
                    case 'number':
                    {
                        htmlSrc += customFieldTemplates.repeaterNumber
                            .replace(/___fieldType___/gi, fieldType)
                            .replace(/___slug___/gi, slug)
                            .replace(/___value___/gi, options.defaultvalue)
                            .replace(/___placeholder___/gi, options.placeholdertext);
                    }
                        break;
                    case 'email':
                    {
                        htmlSrc += customFieldTemplates.repeaterEmail
                            .replace(/___fieldType___/gi, fieldType)
                            .replace(/___slug___/gi, slug)
                            .replace(/___value___/gi, options.defaultvalue)
                            .replace(/___placeholder___/gi, options.placeholdertext);
                    }
                        break;
                    case 'password':
                    {
                        htmlSrc += customFieldTemplates.repeaterPassword
                            .replace(/___fieldType___/gi, fieldType)
                            .replace(/___slug___/gi, slug)
                            .replace(/___value___/gi, options.defaultvalue)
                            .replace(/___placeholder___/gi, options.placeholdertext);
                    }
                        break;
                    case 'image':
                    {
                        htmlSrc += customFieldTemplates.repeaterImage
                            .replace(/___fieldType___/gi, fieldType)
                            .replace(/___slug___/gi, slug);
                    }
                        break;
                    case 'file':
                    {
                        htmlSrc += customFieldTemplates.repeaterFile
                            .replace(/___fieldType___/gi, fieldType)
                            .replace(/___slug___/gi, slug);
                    }
                        break;
                    case 'select':
                    {
                        htmlSrc += customFieldTemplates.repeaterSelect
                            .replace(/___fieldType___/gi, fieldType)
                            .replace(/___slug___/gi, slug)
                            .replace(/___choices___/gi, getChoicesOfSelect(options.selectchoices, options.defaultvalue));
                    }
                        break;
                    case 'checkbox':
                    {
                        htmlSrc += customFieldTemplates.repeaterCheckbox
                            .replace(/___choices___/gi, getChoicesOfCheckbox(options.selectchoices, options.defaultvalue, [fieldType, slug]));
                    }
                        break;
                    case 'radio':
                    {
                        htmlSrc += customFieldTemplates.repeaterRadio
                            .replace(/___choices___/gi, getChoicesOfRadio(options.selectchoices, options.defaultvalue, [fieldType, slug]));
                    }
                        break;
                    case 'wyswyg':
                    {
                        htmlSrc += customFieldTemplates.repeaterWyswyg
                            .replace(/___name___/gi, stringToSlug(slug + addedNodes, '_'))
                            .replace(/___fieldType___/gi, fieldType)
                            .replace(/___slug___/gi, slug)
                            .replace(/___toolbarType___/gi, options.wyswygtoolbar)
                            .replace(/___script___/gi, 'script')
                            .replace(/___scriptEnd___/gi, 'script');
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
                return htmlSrc;
            }

            function getChoicesOfSelect($choicesString, $selectedChoice) {
                $result = '<option value=""></option>';
                $choices = $choicesString.split('\n');
                $.each($choices, function ($key, $row) {
                    $currentArr = $row.split(':');
                    if($currentArr[0] && $currentArr[1]) {
                        $currentArr[0] = $currentArr[0].trim();
                        $currentArr[1] = $currentArr[1].trim();
                    }
                    $result += customFieldTemplates.repeaterSelectChoices
                        .replace(/___value___/gi, $currentArr[0] || '')
                        .replace(/___selected___/gi, (($currentArr[0] == $selectedChoice) ? 'selected="selected"' : ''))
                        .replace(/___title___/gi, $currentArr[1] || 'null');
                });
                return $result;
            }

            function getChoicesOfCheckbox($choicesString, $selectedChoice, $other) {
                $result = '';
                $selectedChoice = $.parseJSON($selectedChoice);
                if (!$selectedChoice) $selectedChoice = [];
                $choices = $choicesString.split('\n');

                $.each($choices, function ($key, $row) {
                    $currentArr = $row.split(':');
                    if($currentArr[0] && $currentArr[1]) {
                        $currentArr[0] = $currentArr[0].trim();
                        $currentArr[1] = $currentArr[1].trim();
                    }
                    $result += customFieldTemplates.repeaterCheckboxChoices
                        .replace(/___fieldType___/gi, $other[0] || '')
                        .replace(/___slug___/gi, $other[1] || '')
                        .replace(/___value___/gi, $currentArr[0] || '')
                        .replace(/___selected___/gi, (($currentArr[0] == $selectedChoice) ? 'checked="checked"' : ''))
                        .replace(/___title___/gi, $currentArr[1] || 'null');
                });
                return $result;
            }

            function getChoicesOfRadio($choicesString, $selectedChoice, $other) {
                $result = '';
                $choices = $choicesString.split('\n');

                $.each($choices, function ($key, $row) {
                    $currentArr = $row.split(':');
                    if($currentArr[0] && $currentArr[1]) {
                        $currentArr[0] = $currentArr[0].trim();
                        $currentArr[1] = $currentArr[1].trim();
                    }
                    $result += customFieldTemplates.repeaterRadioChoices
                        .replace(/___fieldType___/gi, $other[0] || '')
                        .replace(/___slug___/gi, $other[1] || '')
                        .replace(/___value___/gi, $currentArr[0] || '')
                        .replace(/___name___/gi, stringToSlug($other[1] + addedNodes, '_'))
                        .replace(/___selected___/gi, (($currentArr[0] == $selectedChoice) ? 'checked="checked"' : ''))
                        .replace(/___title___/gi, $currentArr[1] || 'null');
                });
                return $result;
            }

            /*Create custom fields - json*/
            function initializeJsonCustomFields() {
                var dataReturn = [];
                // Get data from input field (type equal to text, email, password, phone)
                $('.meta-box.normal-box').each(function (index, el) {
                    var current = $(this);
                    var eachScf = {};
                    eachScf.field_items = [];
                    eachScf.field_slug = current.attr('data-slug');
                    eachScf.field_value = current.find('input:first').val();
                    dataReturn.push(eachScf);
                });
                // Get data from textarea field
                $('.meta-box.textarea-box').each(function (index, el) {
                    var current = $(this);
                    var eachScf = {};
                    var textareaTarget = current.find('> .scf-textarea-wrap > textarea');
                    var editorText = '';
                    if (textareaTarget.attr('id') != '' && textareaTarget.attr('id') != null) {
                        editorText = CKEDITOR.instances[textareaTarget.attr('id')].getData();
                    }
                    else {
                        editorText = textareaTarget.val();
                    }
                    eachScf.field_items = [];
                    eachScf.field_slug = current.attr('data-slug');
                    eachScf.field_value = editorText;
                    dataReturn.push(eachScf);
                });
                // Get data from select box
                $('.meta-box.select-box').each(function (index, el) {
                    var current = $(this);
                    var eachScf = {};
                    eachScf.field_items = [];
                    eachScf.field_slug = current.attr('data-slug');
                    eachScf.field_value = current.find('select').val();
                    dataReturn.push(eachScf);
                });
                // Get data from check box
                $('.meta-box.check-box').each(function (index, el) {
                    var current = $(this);
                    var eachScf = {};
                    eachScf.field_items = [];
                    eachScf.field_slug = current.attr('data-slug');
                    // Get multi data
                    var checkbox_field = [];
                    current.find('input[type="checkbox"]:checked').each(function (index, el) {
                        checkbox_field.push($(this).val());
                    });
                    eachScf.field_value = JSON.stringify(checkbox_field);
                    dataReturn.push(eachScf);
                });
                // Get data from select box
                $('.meta-box.radio-box').each(function (index, el) {
                    var current = $(this);
                    var eachScf = {};
                    eachScf.field_items = [];
                    eachScf.field_slug = current.attr('data-slug');
                    eachScf.field_value = current.find('input[type="radio"]:checked').val();
                    dataReturn.push(eachScf);
                });
                create_json_repeater($('.repeater-box > .scf-repeater-wrap > .sortable-wrapper'), dataReturn);
            }

            /*Add repeater*/
            function create_json_repeater(find_from, update_to) {
                find_from.each(function (index, el) {
                    var current = $(this);
                    var eachRepeater = {};
                    eachRepeater.field_slug = current.attr('data-slug');
                    eachRepeater.field_items = [];
                    current.find('> li').each(function (index, el) {
                        var current_2 = $(this);
                        var itemArr = [];
                        current_2.find(' > .col-xs-12 > .sortable-wrapper.disable-sortable > li').each(function (index, el) {
                            // var val_str = 'item_obj.' + $(this).find('input:first').attr('data-slug') + ' = "' + $(this).find('input:first').val() + '";';
                            // eval(val_str);
                            var childObject = {};
                            var current_3 = $(this);
                            var theInput = current_3.find('input:not([type="checkbox"], [type="radio"])');

                            childObject.field_value = theInput.val();

                            if (theInput.length < 1) {
                                // No input found, find textarea instead
                                theInput = current_3.find('.scf-textarea-wrap > textarea');

                                if (theInput.length < 1) {
                                    // No input found, find select instead
                                    theInput = current_3.find('.scf-select-wrap > select');

                                    if (theInput.length < 1) {
                                        // No select found, find radio instead
                                        theInput = current_3.find('.scf-radio-wrap input[type="radio"]:checked');

                                        // No radio found, find checkbox instead
                                        if (theInput.length < 1) {
                                            theInput = current_3.find('.scf-checkbox-wrap input[type="checkbox"]:checked');
                                        }
                                    }

                                    if (theInput.length > 1) {
                                        var $arr = [];
                                        theInput.each(function (index, el) {
                                            $arr.push($(this).val());
                                        });
                                        childObject.field_value = JSON.stringify($arr);
                                    }
                                    else if (theInput.length > 0) {
                                        childObject.field_value = theInput.val();
                                    }
                                    else {
                                        childObject.field_value = '';
                                    }

                                }
                                else {
                                    var editorText = '';
                                    if (theInput.attr('id') != '' && theInput.attr('id') != null) {
                                        editorText = CKEDITOR.instances[theInput.attr('id')].getData();
                                    }
                                    else {
                                        editorText = theInput.val();
                                    }
                                    childObject.field_value = editorText;
                                }
                            }

                            childObject.field_type = theInput.attr('data-fieldtype');
                            childObject.slug = theInput.attr('data-slug');
                            itemArr.push(childObject);
                        });
                        eachRepeater.field_items.push(itemArr);
                    });
                    update_to.push(eachRepeater);
                });
                $('#custom_fields_container').val('').html('');
                $('#custom_fields_container').val(JSON.stringify(update_to));
                $('#custom_fields_container').html(JSON.stringify(update_to));
            }
        }
    };
}();