@extends('admin._master')

@section('page-toolbar')

@endsection

@section('css')

@endsection

@section('js')

@endsection

@section('js-init')
    <script>
        $(document).ready(function () {
            Utility.convertTitleToSlug('.the-object-title', '.the-object-slug');

            $('.js-validate-form').validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {},
                rules: {
                    name: {
                        minlength: 1,
                        maxlength: 255,
                        required: true
                    },
                    slug: {
                        required: true,
                        minlength: 1,
                        maxlength: 255
                    },
                    value: {
                        required: true,
                        minlength: 1,
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
        });
    </script>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="note note-danger">
                <p><label class="label label-danger">NOTE</label> You need to enable javascript.</p>
            </div>

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-note font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Base attribute set: <a href="{{ '/' . $adminCpAccess . '/product-attribute-sets/edit/' . $attributeSet->id }}" class="font-red" title="{{ $attributeSet->title or '' }}">{{ $attributeSet->title or '' }}</a></span>
                    </div>
                </div>
                <div class="portlet-body clearfix">
                    <div class="row">
                        <div class="col-lg-6">
                            <form class="js-validate-form" method="POST" accept-charset="utf-8" action="" novalidate>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label><b>Name <span class="text-danger">(*)</span></b></label>
                                    <input required type="text" name="name" class="form-control the-object-title"
                                           value="{{ $object->name or '' }}" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label><b>Slug <span class="text-danger">(*)</span></b></label>
                                    <input type="text" name="slug" class="form-control the-object-slug"
                                           value="{{ $object->slug or '' }}" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label><b>Value <span class="text-danger">(*)</span></b></label>
                                    <input type="text" name="value" class="form-control"
                                           value="{{ $object->value or '' }}" autocomplete="off">
                                </div>
                                <div class="form-group mar-bot-0">
                                    <button class="btn btn-transparent btn-success active btn-circle" type="submit">
                                        <i class="fa fa-check"></i> Save & continue edit
                                    </button>
                                    <button class="btn btn-transparent btn-success active btn-circle" type="submit" name="save_and_go_back" value="1">
                                        <i class="fa fa-check"></i> Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
