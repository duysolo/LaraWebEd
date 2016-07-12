@extends('admin._master')

@section('page-toolbar')

@endsection

@section('css')
    <link rel="stylesheet" href="/admin/core/third_party/bootstrap-tagsinput/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="/admin/core/third_party/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="/admin/core/third_party/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
    <style>
        #tab_attributes .col-md-6 {
            float : left;
        }

        #tab_attributes .col-md-6:nth-child(2n+2) {
            float : right;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript"
            src="/admin/core/third_party/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript"
            src="/admin/core/third_party/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <script type="text/javascript" src="/admin/core/third_party/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/admin/core/third_party/ckeditor/config.js"></script>
    <script type="text/javascript" src="/admin/core/third_party/ckeditor/adapters/jquery.js"></script>

    <script type="text/javascript" src="/admin/dist/pages/product-attributes.js"></script>

    {{--Custom field templates--}}
    @include('admin._shared._custom-field-templates')
@endsection

@section('js-init')
    <script type="text/javascript">
        $(document).ready(function () {
            $.validator.addMethod("greaterThanFromDate", function (value, element, param) {
                var $to = new Date(value);
                var $from = new Date($(param).val());
                return $to > $from;
            }, "Start day must be small than end day");

            $('.js-ckeditor').ckeditor({});

            $('body').on('change', 'input[name=sale_status]', function (event) {
                var $saleFormInput = $('input.form-date-time');
                var $saleFormInputWrapper = $('.sale-group-from-to');
                var $checkedValue = parseInt($('input[name=sale_status]:checked').val());
                if ($checkedValue == 0) {
                    $saleFormInput.attr('disabled', '');
                    $saleFormInputWrapper.hide();
                }
                else {
                    $saleFormInput.removeAttr('disabled');
                    $saleFormInputWrapper.show();
                }
            });
            $('input[name=sale_status]').trigger('change');

            $(".form-date-time").datetimepicker({
                autoclose: true,
                format: "yyyy-mm-dd hh:ii:ss",
                pickerPosition: "bottom-right",
                todayBtn: true,
                todayHighlight: true,
                minuteStep: 1
            });

            $('.js-tags-editor').tagsinput({
                'tagClass': 'label label-default'
            });

            Utility.convertTitleToSlug('.the-object-title', '.the-object-slug');

            $('.js-validate-form').validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                errorPlacement: function (error, element) {
                    if (element.closest('.input-group').length > 0) {
                        error.insertAfter(element.closest('.input-group'));
                    }
                },
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {},
                rules: {
                    title: {
                        minlength: 3,
                        maxlength: 255,
                        required: true
                    },
                    slug: {
                        required: true,
                        minlength: 3,
                        maxlength: 255
                    },
                    description: {
                        maxlength: 255
                    },
                    sale_from: {
                        date: true
                    },
                    sale_to: {
                        date: true,
                        greaterThanFromDate: '[name=sale_from]'
                    },
                    price: {
                        number: true,
                        required: true,
                        min: 0
                    },
                    old_price: {
                        number: true,
                        required: true,
                        min: 0
                    }
                },

                highlight: function (element) {
                    $(element).closest('.form-group').addClass('has-error').removeClass('has-success'); // set error class to the control group
                },

                unhighlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label.closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                }
            });

            /*Handle custom fields*/
            Utility.handleCustomFields();

            @if(isset($object->id) && $object->id)
                $('body').on('click', '.tab-change-url a[data-toggle=tab]', function (event) {
                var currentLink = '{{ '/'.$adminCpAccess.'/products/edit/'.$object->id.'/'.$currentEditLanguage->id }}';
                window.history.pushState('', '', currentLink + $(this).attr('href'));
            });
            @endif
        });
    </script>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="note note-danger">
                <p><label class="label label-danger">NOTE</label> You need to enable javascript.</p>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="clearfix">
                        <div class="portlet">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-shopping-cart"></i>{{ $object->global_title or 'New product' }}
                                </div>
                                <div class="actions btn-set">
                                    <a type="button" href="{{ asset($adminCpAccess.'/products') }}"
                                       class="btn btn-secondary-outline default">
                                        <i class="fa fa-angle-left"></i> Back
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="tabbable-bordered">
                                    <?php
                                    $currentTab = Request::get('tab', 'tab_general');
                                    ?>
                                    <ul class="nav nav-tabs tab-change-url">
                                        <li class="{{ $currentTab == 'tab_general' ? 'active' : '' }}">
                                            <a href="?tab=tab_general" data-target="#tab_general" data-toggle="tab">General</a>
                                        </li>
                                        @if($currentId != 0)
                                            @if(isset($attributeSet) && $attributeSet->count())
                                                <li class="{{ $currentTab == 'tab_attributes' ? 'active' : '' }}">
                                                    <a href="?tab=tab_attributes" data-target="#tab_attributes"
                                                       data-toggle="tab">Attributes</a>
                                                </li>
                                            @endif
                                            <li class="{{ $currentTab == 'tab_reviews' ? 'active' : '' }}">
                                                <a href="?tab=tab_reviews" data-target="#tab_reviews" data-toggle="tab">Reviews</a>
                                            </li>
                                            <li class="{{ $currentTab == 'tab_customfields' ? 'active' : '' }}">
                                                <a href="?tab=tab_customfields" data-target="#tab_customfields"
                                                   data-toggle="tab">Custom fields</a>
                                            </li>
                                        @endif
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane {{ $currentTab == 'tab_general' ? 'active' : '' }}"
                                             id="tab_general">
                                            <form class="js-validate-form form-horizontal form-row-seperated" method="POST" accept-charset="utf-8"
                                                  action="" novalidate>
                                                {{ csrf_field() }}
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Language:
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-10">
                                                            <select name="language_id"
                                                                    data-href="{{ $rawUrlChangeLanguage }}"
                                                                    class="form-control input-medium js-change-content-language">
                                                                @foreach($activatedLanguages as $key => $row)
                                                                    <option value="{{ $row->id }}" {{ ($currentEditLanguage->id == $row->id) ? 'selected' : '' }}>{{ $row->language_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Name:
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-10">
                                                            <input required type="text" name="title"
                                                                   class="form-control the-object-title"
                                                                   value="{{ $object->title or '' }}"
                                                                   autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">SKU:
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-10">
                                                            <input required type="text" name="sku"
                                                                   class="form-control"
                                                                   value="{{ $object->sku or '' }}"
                                                                   autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Friendly slug:
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-10">
                                                            <input type="text" name="slug"
                                                                   class="form-control the-object-slug"
                                                                   value="{{ $object->slug or '' }}" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    @if(isset($object) && $object->slug)
                                                        <div class="form-group">
                                                            <div class="col-md-10 col-md-push-2">
                                                                <a target="_blank"
                                                                   href="{{ _getProductLink($object, $currentEditLanguage->language_code) }}"
                                                                   class="btn btn-default"
                                                                   type="button">{{ asset(_getProductLink($object, $currentEditLanguage->language_code)) }}</a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Tags:</label>
                                                        <div class="col-md-10">
                                                            <input type="text" name="tags"
                                                                   class="form-control js-tags-editor"
                                                                   value="{{ $object->tags or '' }}" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Label:</label>
                                                        <div class="col-md-10">
                                                            <input type="text" name="label"
                                                                   class="form-control js-tags-editor"
                                                                   value="{{ $object->label or '' }}"
                                                                   autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Description:</label>
                                                        <div class="col-md-10">
                                                            <textarea name="description" class="form-control"
                                                                      rows="5">{{ $object->description or '' }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Page template:</label>
                                                        <div class="col-md-10">
                                                            <select name="page_template" class="form-control">
                                                                <option value=""></option>
                                                                @foreach (_getPageTemplate('Product') as $key => $row)
                                                                    <option {{ (isset($object) && $object->page_template == $row) ? 'selected="selected"' : '' }} value="{{ $row }}">{{ $row }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Brand:</label>
                                                        <div class="col-md-10">
                                                            <select name="brand_id" class="form-control">
                                                                <option value=""></option>
                                                                @if(isset($brands)) @foreach ($brands as $key => $row)
                                                                    <option {{ (isset($object) && $object->brand_id == $row->id) ? 'selected="selected"' : '' }} value="{{ $row->id }}">{{ $row->name }}</option>
                                                                @endforeach @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if(isset($categoriesHtml) && trim($categoriesHtml) != '')
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Categories:</label>
                                                            <div class="col-md-10">
                                                                <div class="form-control height-auto">
                                                                    <div style="max-height: 300px; overflow: auto;">
                                                                        {!! $categoriesHtml !!}
                                                                    </div>
                                                                </div>
                                                                <span class="help-block"> select one or more categories </span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Content:</label>
                                                        <div class="col-md-10">
                                                            <textarea name="content"
                                                                      class="form-control js-ckeditor">{{ $object->content or '' }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Price:
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-10">
                                                            <div class="input-group input-medium">
                                                                <input type="text" class="form-control" name="price"
                                                                       placeholder=""
                                                                       value="{{ $object->price or 0 }}">
                                                                <span class="input-group-addon">{{ $currentEditLanguage->currency }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Old price:</label>
                                                        <div class="col-md-10">
                                                            <div class="input-group input-medium">
                                                                <input type="text" class="form-control" name="old_price"
                                                                       placeholder=""
                                                                       value="{{ $object->old_price or 0 }}">
                                                                <span class="input-group-addon">{{ $currentEditLanguage->currency }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Out of stock:</label>
                                                        <div class="col-md-10">
                                                            <div class="md-checkbox" style="margin: 5px 0;">
                                                                <input type="checkbox" value="1" id="is_out_of_stock"
                                                                       name="is_out_of_stock"
                                                                       {{ isset($object->is_out_of_stock) && $object->is_out_of_stock == 1 ? 'checked' : '' }} class="md-radiobtn">
                                                                <label for="is_out_of_stock">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> This product is out of
                                                                    stock
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Sale status:</label>
                                                        <div class="col-md-10">
                                                            <?php
                                                            $saleStatus = 1;
                                                            if (!isset($object) || $object->sale_status != 1) {
                                                                $saleStatus = 0;
                                                            }

                                                            ?>
                                                            <div class="md-radio" style="margin: 5px 0;">
                                                                <input type="radio" value="0" id="always_on_sale"
                                                                       name="sale_status"
                                                                       {{ ($saleStatus != 1) ? 'checked' : '' }} class="md-radiobtn">
                                                                <label for="always_on_sale">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> Always on sale
                                                                </label>
                                                            </div>
                                                            <div class="md-radio">
                                                                <input type="radio" value="1"
                                                                       id="sale_with_limited_time" name="sale_status"
                                                                       {{ ($saleStatus == 1) ? 'checked' : '' }} class="md-radiobtn">
                                                                <label for="sale_with_limited_time">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> Sale with limited time
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group sale-group-from-to">
                                                        <label class="col-md-2 control-label">Sale this product:</label>
                                                        <div class="col-md-10">
                                                            <div class="input-group input-daterange">
                                                                <input type="text" class="form-control form-date-time"
                                                                       name="sale_from"
                                                                       placeholder=""
                                                                       value="{{ $object->sale_from or date('Y-m-d H:i:s', time()) }}"
                                                                       data-date="{{ (isset($object->sale_from)) ? _getTimestampOrDefault($object->sale_from) : date('Y-m-d H:i:s', time()) }}">
                                                                <span class="input-group-addon">to</span>
                                                                <input type="text" class="form-control form-date-time"
                                                                       name="sale_to"
                                                                       placeholder=""
                                                                       value="{{ $object->sale_to or date('Y-m-d H:i:s', time()) }}"
                                                                       data-date="{{ (isset($object->sale_to)) ? _getTimestampOrDefault($object->sale_to) : date('Y-m-d H:i:s', time()) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Status:</label>
                                                        <div class="col-md-10">
                                                            <select name="status" class="form-control input-medium">
                                                                <option value="1" {{ (isset($object) && $object->status == 1) ? 'selected' : '' }}>
                                                                    Published
                                                                </option>
                                                                <option value="0" {{ (isset($object) && $object->status == 0) ? 'selected' : '' }}>
                                                                    Disabled
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Thumbnail:</label>
                                                        <div class="col-md-10">
                                                            <div class="select-media-box">
                                                                <button type="button"
                                                                        class="btn blue show-add-media-popup">Choose
                                                                    image
                                                                </button>
                                                                <div class="clearfix"></div>
                                                                <a title="" class="show-add-media-popup">
                                                                    <img src="{{ (isset($object) && trim($object->thumbnail != '')) ? $object->thumbnail : '/admin/images/no-image.png' }}"
                                                                         alt="Thumbnail" class="img-responsive">
                                                                </a>
                                                                <input type="hidden" name="thumbnail"
                                                                       value="{{ $object->thumbnail or '' }}"
                                                                       class="input-file hidden">
                                                                <a title="" class="remove-image"><span>&nbsp;</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mar-bot-0">
                                                        <div class="col-md-10 col-md-push-2 text-right">
                                                            <button class="btn btn-success btn-circle" type="submit">
                                                                <i class="fa fa-check"></i> Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        @if($currentId != 0)
                                            @if(isset($attributeSet) && $attributeSet->count())
                                                <div class="tab-pane {{ $currentTab == 'tab_attributes' ? 'active' : '' }}"
                                                     id="tab_attributes">
                                                    <form class="js-validate-form update-attributes-form clearfix"
                                                          method="POST" accept-charset="utf-8"
                                                          action="" novalidate>
                                                        {!! csrf_field() !!}
                                                        <textarea name="product_attributes" id="product_attributes"
                                                                  class="hidden" style="display: none;"></textarea>
                                                        <div class="mar-bot-15 text-right">
                                                            <button class="btn btn-success btn-circle" type="submit">
                                                                <i class="fa fa-check"></i> Save
                                                            </button>
                                                        </div>
                                                        <div class="row">
                                                            @if(isset($attributeSet) && $attributeSet)
                                                                @foreach($attributeSet as $key => $row)
                                                                    <div class="col-md-6 attribute-set-group">
                                                                        <div class="portlet light bordered">
                                                                            <div class="portlet-title">
                                                                                <div class="caption">
                                                                                    <i class="icon-note font-dark"></i>
                                                                                    <span class="caption-subject font-dark sbold uppercase">{{ $row->title or '' }}</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="portlet-body clearfix">
                                                                                <?php
                                                                                $attributes = $row->productAttribute()->get();
                                                                                ?>
                                                                                <div class="table-responsive">
                                                                                    <table class="table v-middle">
                                                                                        <colgroup>
                                                                                            <col width="50px">
                                                                                            <col width="150px">
                                                                                            <col width="150px">
                                                                                            <col width="50px">
                                                                                        </colgroup>
                                                                                        <thead>
                                                                                        <tr>
                                                                                            <th>Activated</th>
                                                                                            <th>Name</th>
                                                                                            <th>Change price</th>
                                                                                            <th>Is percentage</th>
                                                                                        </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                        @if($attributes) @foreach($attributes as $keyAttribute => $rowAttribute)
                                                                                            <?php
                                                                                            $currentAttr = null;
                                                                                            foreach ($activatedAttributes as $keyActivated => $rowActivated) {
                                                                                                if ($rowActivated->attribute_id == $rowAttribute->id) {
                                                                                                    $currentAttr = $rowActivated;
                                                                                                    $activatedAttributes->forget($keyActivated);
                                                                                                    break;
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                            <tr data-attribute-id="{{ $rowAttribute->id or '' }}">
                                                                                                <td>
                                                                                                    <label class="mt-checkbox mt-checkbox-outline mar-bot-0">
                                                                                                        <input type="checkbox"
                                                                                                               class="active-checkbox" {{ ($currentAttr) ? 'checked' : '' }}>
                                                                                                        <span></span>
                                                                                                    </label>
                                                                                                </td>
                                                                                                <td>{{ $rowAttribute->name or '' }}</td>
                                                                                                <td>
                                                                                                    <input type="text"
                                                                                                           class="form-control input-sm change-price"
                                                                                                           value="{{ ($currentAttr) ? $currentAttr->change_price : 0 }}"
                                                                                                           style="width: 150px;">
                                                                                                </td>
                                                                                                <td>
                                                                                                    <label class="mt-checkbox mt-checkbox-outline mar-bot-0">
                                                                                                        <input type="checkbox"
                                                                                                               class="is-percentage" {{ ($currentAttr && (int)$currentAttr->is_percentage) ? 'checked' : '' }}>
                                                                                                        <span></span>
                                                                                                    </label>
                                                                                                </td>
                                                                                            </tr>
                                                                                        @endforeach @endif
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="mar-bot-0 text-right">
                                                            <button class="btn btn-success btn-circle" type="submit">
                                                                <i class="fa fa-check"></i> Save
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
                                            <div class="tab-pane {{ $currentTab == 'tab_reviews' ? 'active' : '' }}"
                                                 id="tab_reviews"></div>
                                            <div class="tab-pane {{ $currentTab == 'tab_customfields' ? 'active' : '' }}"
                                                 id="tab_customfields">
                                                @if(isset($customFieldBoxes) && $customFieldBoxes)
                                                    <form class="update-custom-fields-form" method="POST"
                                                          accept-charset="utf-8"
                                                          action="" novalidate>
                                                        {{ csrf_field() }}
                                                        <div class="form-group mar-bot-20">
                                                            <div class="text-right">
                                                                <button class="btn btn-success btn-circle"
                                                                        type="submit">
                                                                    <i class="fa fa-check"></i> Save
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                         <textarea name="custom_fields" id="custom_fields_container"
                                                                   class="hidden form-control"
                                                                   style="display: none !important;"
                                                                   cols="30" rows="10"></textarea>
                                                        {!! $customFieldBoxes or '' !!}
                                                        <div class="form-group mar-bot-0">
                                                            <div class="text-right">
                                                                <button class="btn btn-success btn-circle"
                                                                        type="submit">
                                                                    <i class="fa fa-check"></i> Save
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @endif
                                                <div class="clearfix"></div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
