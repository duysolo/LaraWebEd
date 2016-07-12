@extends('admin._master')

@section('page-toolbar')

@endsection

@section('css')
    <link rel="stylesheet" href="/admin/core/third_party/bootstrap-tagsinput/bootstrap-tagsinput.css">
@endsection

@section('js')
    <script type="text/javascript" src="/admin/core/third_party/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <script type="text/javascript" src="/admin/core/third_party/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/admin/core/third_party/ckeditor/config.js"></script>
    <script type="text/javascript" src="/admin/core/third_party/ckeditor/adapters/jquery.js"></script>

    {{--Custom field templates--}}
    @include('admin._shared._custom-field-templates')
@endsection

@section('js-init')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.js-ckeditor').ckeditor({

            });

            $('.js-tags-editor').tagsinput({
                'tagClass': 'label label-default'
            });

            Utility.convertTitleToSlug('.the-object-title', '.the-object-slug');

            $('.js-validate-form').validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {

                },
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
                <form class="js-validate-form" method="POST" accept-charset="utf-8" action="" novalidate>
                    {{ csrf_field() }}
                    <textarea name="custom_fields" id="custom_fields_container" class="hidden form-control" style="display: none !important;" cols="30" rows="10"></textarea>
                    <div class="col-md-9">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-note font-dark"></i>
                                    <span class="caption-subject font-dark sbold uppercase">Basic information</span>
                                </div>
                                <div class="actions">

                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="form-group">
                                    <label><b>Title <span class="text-danger">(*)</span></b></label>
                                    <input required type="text" name="title" class="form-control the-object-title" value="{{ $object->title or '' }}" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label><b>Friendly slug <span class="text-danger">(*)</span></b></label>
                                    <input type="text" name="slug" class="form-control the-object-slug" value="{{ $object->slug or '' }}" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label><b>Description</b></label>
                                    <textarea name="description" class="form-control" rows="5">{{ $object->description or '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label><b>Tags (use for search)</b></label>
                                    <input type="text" name="tags" class="form-control js-tags-editor" value="{{ $object->tags or '' }}" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label><b>Page template</b></label>
                                    <select name="page_template" class="form-control">
                                        <option value=""></option>
                                        @foreach (_getPageTemplate('Category') as $key => $row)
                                            <option {{ (isset($object) && $object->page_template == $row) ? 'selected="selected"' : '' }} value="{{ $row }}">{{ $row }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label><b>Parent category</b></label>
                                    <select name="parent_id" class="form-control">
                                        <option value=""></option>
                                        {!! $categoriesHtmlSrc !!}
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label><b>Content</b></label>
                                    <textarea name="content" class="form-control js-ckeditor">{{ $object->content or '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-note font-dark"></i>
                                    <span class="caption-subject font-dark sbold uppercase">Other information</span>
                                </div>
                                <div class="actions">
                                    <!--div class="btn-group btn-group-devided">
                                        <button class="btn btn-transparent btn-success btn-circle btn-sm active" type="submit">
                                            <i class="fa fa-check"></i> Save
                                        </button>
                                    </div-->
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="form-group">
                                    <label><b>Language</b></label>
                                    <select name="language_id" data-href="{{ $rawUrlChangeLanguage }}" class="form-control js-change-content-language">
                                        @foreach($activatedLanguages as $key => $row)
                                            <option value="{{ $row->id }}" {{ ($currentEditLanguage->id == $row->id) ? 'selected' : '' }}>{{ $row->language_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label><b>Status</b></label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{ (isset($object) && $object->status == 1) ? 'selected' : '' }}>Published</option>
                                        <option value="0" {{ (isset($object) && $object->status == 0) ? 'selected' : '' }}>Disabled</option>
                                        <option value="2" {{ (isset($object) && $object->status == 2) ? 'selected' : '' }}>Draft</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label><b>Thumbnail image</b></label>
                                    <div class="select-media-box">
                                        <button type="button" class="btn blue show-add-media-popup">Choose image</button>
                                        <div class="clearfix"></div>
                                        <a title="" class="show-add-media-popup"><img src="{{ (isset($object) && trim($object->thumbnail != '')) ? $object->thumbnail : '/admin/images/no-image.png' }}" alt="Thumbnail" class="img-responsive"></a>
                                        <input type="hidden" name="thumbnail" value="{{ $object->thumbnail or '' }}" class="input-file">
                                        <a title="" class="remove-image"><span>&nbsp;</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet-title portlet-footer">
                                <div class="actions">
                                    <div class="btn-group btn-group-devided">
                                        <button class="btn btn-transparent btn-success active btn-circle" type="submit">
                                            <i class="fa fa-check"></i> Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-md-9">
                    {!! $customFieldBoxes or '' !!}
                </div>
            </div>
        </div>
    </div>
@endsection
