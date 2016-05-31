@extends('admin._master')

@section('page-toolbar')

@endsection

@section('css')

@endsection

@section('js')

@endsection

@section('js-init')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.js-validate-form').validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                errorPlacement: function(error, element) {
                    if(element.closest('.input-group').length > 0)
                    {
                        error.insertAfter(element.closest('.input-group'));
                    }
                },
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {},
                rules: {
                    username: {
                        minlength: 5,
                        required: true
                    },
                    current_password: {
                        minlength: 5,
                        required: true
                    },
                    password: {
                        minlength: 5,
                        required: true
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 5,
                        equalTo: '[type="password"][name="password"]'
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
            <div class="row">
                <form class="js-validate-form" method="POST" accept-charset="utf-8" action="" novalidate>
                    {{ csrf_field() }}
                    <div class="col-md-9">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-note font-dark"></i>
                                    <span class="caption-subject font-dark sbold uppercase">Basic information</span>

                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="form-group">
                                    <label><b>Username <span class="text-danger">(*)</span></b></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control" autocomplete="off" value="{{ $object->username or '' }}" @if(isset($object) && $object->username) disabled readonly @else name="username" @endif>
                                    </div>
                                </div>
                                @if(isset($object) && $needToInputCurrentPassword)
                                    <div class="form-group">
                                        <label><b>Current password <span class="text-danger">(*)</span></b></label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-lock"></i>
                                            </span>
                                            <input type="password" class="form-control" value="" name="current_password" autocomplete="off">
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label><b>New password <span class="text-danger">(*)</span></b></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                        <input type="password" class="form-control" value="" name="password" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><b>Confirm password <span class="text-danger">(*)</span></b></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                        <input type="password" class="form-control" value="" name="password_confirmation">
                                    </div>
                                </div>
                            </div>
                            <div class="portlet-title portlet-footer">
                                <div class="actions">
                                    <div class="btn-group btn-group-devided">
                                        <button class="btn btn-transparent btn-success active btn-circle"
                                                type="submit">
                                            <i class="fa fa-check"></i> Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
