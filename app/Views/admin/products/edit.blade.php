@extends('admin._master')

@section('page-toolbar')

@endsection

@section('css')
    <link rel="stylesheet" href="/admin/core/third_party/bootstrap-tagsinput/bootstrap-tagsinput.css">
@endsection

@section('js')
    <script type="text/javascript"
            src="/admin/core/third_party/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <script type="text/javascript" src="/admin/core/third_party/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/admin/core/third_party/ckeditor/config.js"></script>
    <script type="text/javascript" src="/admin/core/third_party/ckeditor/adapters/jquery.js"></script>
@endsection

@section('js-init')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.js-ckeditor').ckeditor({

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
                        required: true
                    },
                    slug: {
                        required: true,
                        minlength: 3
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
                    $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
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
                    <div class="form-horizontal form-row-seperated">
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
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_general" data-toggle="tab"> General </a>
                                        </li>
                                        @if($currentId != 0)
                                        <li>
                                            <a href="#tab_other" data-toggle="tab"> Other </a>
                                        </li>
                                        @endif
                                        <!--li>
                                            <a href="#tab_reviews" data-toggle="tab"> Reviews
                                                <span class="badge badge-success"> 3 </span>
                                            </a>
                                        </li-->
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_general">
                                            <form class="js-validate-form" method="POST" accept-charset="utf-8"
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
                                                        <label class="col-md-2 control-label">Friendly slug:
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-10">
                                                            <input type="text" name="slug" class="form-control the-object-slug"
                                                                   value="{{ $object->slug or '' }}" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    @if(isset($object) && $object->slug)
                                                        <div class="form-group">
                                                            <div class="col-md-10 col-md-push-2">
                                                                <a target="_blank"
                                                                   href="{{ asset($currentEditLanguage->language_code.'/'.trans('url.product')) }}/{{ $object->slug or '' }}"
                                                                   class="btn btn-default" type="button">
                                                                    {{ asset($currentEditLanguage->language_code.'/'.trans('url.product')) }}
                                                                    /{{ $object->slug or '' }}
                                                                </a>
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
                                                                @foreach (_getPageTemplate('Page') as $key => $row)
                                                                    <option {{ (isset($object) && $object->page_template == $row) ? 'selected="selected"' : '' }} value="{{ $row }}">{{ $row }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if(isset($categoriesHtml) && trim($categoriesHtml) != '')
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Categories:</label>
                                                            <div class="col-md-10">
                                                                <div class="form-control height-auto">
                                                                    <div class="scroller" style="max-height: 300px;"
                                                                         data-always-visible="1" data-rail-visible1="1">
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
                                                                       value="{{ $object->old_price or '' }}">
                                                                <span class="input-group-addon">{{ $currentEditLanguage->currency }}</span>
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
                                                                <option value="2" {{ (isset($object) && $object->status == 2) ? 'selected' : '' }}>
                                                                    Draft
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Thumbnail:</label>
                                                        <div class="col-md-10">
                                                            <div class="select-media-box">
                                                                <button type="button"
                                                                        class="btn blue show-add-media-popup">Choose image
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
                                            <div class="tab-pane" id="tab_other">
                                                {!! $customFieldBoxes or '' !!}
                                                <form class="update-custom-fields-form" method="POST" accept-charset="utf-8"
                                                      action="" novalidate>
                                                    {{ csrf_field() }}
                                                    <textarea name="custom_fields" id="custom_fields_container"
                                                              class="hidden form-control" style="display: none !important;"
                                                              cols="30" rows="10"></textarea>
                                                    <div class="form-group mar-bot-0">
                                                        <div class="col-md-10 col-md-push-2 text-right">
                                                            <button class="btn btn-success btn-circle" type="submit">
                                                                <i class="fa fa-check"></i> Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="js-validate-form" method="POST" accept-charset="utf-8" action="" novalidate>
                    {{ csrf_field() }}

                </form>
                <div class="col-md-12">

                </div>
            </div>
        </div>
    </div>
@endsection