@extends('admin._master')

@section('page-toolbar')

@endsection

@section('css')

@endsection

@section('js')

@endsection

@section('js-init')
    <script type="text/javascript">
        (function($){
            $(document).ready(function(){
                $('.js-validate-form').validate({
                    errorElement: 'span', //default input error message container
                    errorClass: 'help-block help-block-error', // default input error message class
                    focusInvalid: false, // do not focus the last invalid input
                    ignore: "",  // validate all fields including form hidden input
                    messages: {},
                    rules: {
                        name: {
                            minlength: 3,
                            maxlength: 255,
                            required: true
                        },
                        thumbnail: {
                            required: true,
                            maxlength: 255
                        },
                        link: {
                            minlength: 3,
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
        })(jQuery);
    </script>
@endsection

@section('content')
    <div class="portlet light form-fit bordered">
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form class="js-validate-form form-horizontal form-bordered" method="POST" accept-charset="utf-8" action="" novalidate>
                {{ csrf_field() }}
                <div class="form-body">
                    <div class="form-group">
                        <div class="col-md-3 text-right">Name</div>
                        <div class="col-md-7">
                            <input required type="text" name="name" class="form-control"
                                   value="{{ $object->name or '' }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 text-right">Link</div>
                        <div class="col-md-7">
                            <input type="text" name="link" class="form-control"
                                   value="{{ $object->link or '' }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 text-right">Status</div>
                        <div class="col-md-7">
                            <select name="status" class="form-control">
                                <option value="1" {{ (isset($object) && $object->status == 1) ? 'selected' : '' }}>Activated</option>
                                <option value="0" {{ (isset($object) && $object->status == 0) ? 'selected' : '' }}>Disabled</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 text-right">Thumbnail</div>
                        <div class="col-md-7">
                            <div class="select-media-box">
                                <button type="button" class="btn blue show-add-media-popup">Choose image
                                </button>
                                <div class="clearfix"></div>
                                <a title="" class="show-add-media-popup"><img
                                            src="{{ (isset($object) && trim($object->thumbnail != '')) ? $object->thumbnail : '/admin/images/no-image.png' }}"
                                            alt="Thumbnail" class="img-responsive"></a>
                                <input type="hidden" name="thumbnail" value="{{ $object->thumbnail or '' }}"
                                       class="input-file">
                                <a title="" class="remove-image"><span>&nbsp;</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-7 col-md-push-3">
                            <button class="btn btn-transparent btn-success active btn-circle" type="submit">
                                <i class="fa fa-check"></i> Save
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- END FORM-->
        </div>
    </div>
@endsection
