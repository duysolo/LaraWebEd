@extends('admin._master')

@section('page-toolbar')

@endsection

@section('css')
    <link rel="stylesheet" href="/admin/core/third_party/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
@endsection

@section('js')
    <script type="text/javascript" src="/admin/core/third_party/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
@endsection

@section('js-init')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.js-date-picker').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true
            });
            var $rules = {
                email: {
                    minlength: 5,
                    required: true,
                    email: true
                },
                first_name: {
                    minlength: 5,
                    required: true
                },
                last_name: {
                    minlength: 5,
                    required: true
                },
                phone: {
                    minlength: 5,
                    required: true
                },
                date_of_birth: {
                    minlength: 5,
                    required: true
                },
                sex: {
                    required: true
                }
            };
            $('.js-validate-form').validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                errorPlacement: function (error, element) {
                    if (element.closest('.input-group').length > 0) {
                        error.insertAfter(element.closest('.input-group'));
                    }
                    else
                    {
                        element.closest('.form-group').append(error);
                    }
                },
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {},
                rules: $rules,

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
            $('.js-validate-form-change-password').validate({
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
                rules: $rules,

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
            <!-- BEGIN PROFILE SIDEBAR -->
            <div class="profile-sidebar">
                <!-- PORTLET MAIN -->
                <div class="portlet light profile-sidebar-portlet pad-bot-20">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img src="{{ (isset($object) && $object->avatar) ? $object->avatar : '/admin/images/no-image.png' }}" class="img-responsive" alt=""></div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">{{ $object->full_name or '' }}</div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                </div>
                <!-- END PORTLET MAIN -->
            </div>
            <!-- END BEGIN PROFILE SIDEBAR -->
            <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light ">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-dark bold uppercase">Profile Account</span>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <!-- PERSONAL INFO TAB -->
                                    <div class="tab-pane active" id="tab_1_1">
                                        <form class="js-validate-form" method="POST" accept-charset="utf-8" action=""
                                              novalidate>
                                            {!! csrf_field() !!}
                                            <div class="form-group">
                                                <label class="control-label "><b>Email</b></label>
                                                <input type="text" value="{{ $object->email or '' }}"
                                                       name="email"
                                                       autocomplete="off"
                                                       {{ isset($object) && $object->id != 0 ? 'disabled' : '' }}
                                                       class="form-control"/>
                                            </div>
                                            @if($object->id == 0)
                                                <div class="form-group">
                                                    <label class="control-label "><b>Password</b></label>
                                                    <input type="text" value=""
                                                           name="password"
                                                           autocomplete="off"
                                                           class="form-control"/>
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label class="control-label "><b>First name</b></label>
                                                <input type="text" value="{{ $object->first_name or '' }}"
                                                       name="first_name"
                                                       autocomplete="off"
                                                       class="form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label"><b>Last name</b></label>
                                                <input type="text" value="{{ $object->last_name or '' }}"
                                                       name="last_name"
                                                       autocomplete="off"
                                                       class="form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label"><b>Phone</b></label>
                                                <input type="text" value="{{ $object->phone or '' }}"
                                                       name="phone"
                                                       autocomplete="off"
                                                       class="form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label"><b>Birthday</b></label>
                                                <input type="text" value="{{ $object->date_of_birth or '' }}"
                                                       name="date_of_birth"
                                                       data-date-format="yyyy-mm-dd"
                                                       autocomplete="off"
                                                       readonly
                                                       class="form-control js-date-picker"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label"><b>Sex</b></label>
                                                <br>
                                                <label>
                                                    <input type="radio" name="sex" value="1"
                                                            {{ (isset($object) && $object->sex == 1) ? 'checked' : '' }}> Male
                                                </label>
                                                <label>
                                                    <input type="radio" name="sex" value="0"
                                                            {{ (!isset($object) || $object->sex == 0 || !$object->sex) ? 'checked' : '' }}> Female
                                                </label>
                                                <label>
                                                    <input type="radio" name="sex" value="2"
                                                            {{ (isset($object) && $object->sex == 2) ? 'checked' : '' }}> Other
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label"><b>About</b></label>
                                                <textarea class="form-control"
                                                          name="description"
                                                          rows="3">{!! $object->description or '' !!}</textarea>
                                            </div>
                                            <div class="mar-top-10">
                                                <button type="submit" class="btn green">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END PERSONAL INFO TAB -->
                                    <!-- CHANGE AVATAR TAB -->
                                    <div class="tab-pane" id="tab_1_2">
                                        <form class="js-validate-form-change-avatar" method="POST" accept-charset="utf-8" action=""
                                              novalidate>
                                            {!! csrf_field() !!}
                                            <div class="form-group">
                                                <div class="select-media-box">
                                                    <button type="button" class="btn blue show-add-media-popup">Choose image</button>
                                                    <div class="clearfix"></div>
                                                    <a title="" class="show-add-media-popup"><img src="{{ (isset($object) && trim($object->avatar != '')) ? $object->avatar : '/admin/images/no-image.png' }}" alt="Thumbnail" class="img-responsive"></a>
                                                    <input type="hidden" name="avatar" value="{{ $object->avatar or '' }}" class="input-file">
                                                    <a title="" class="remove-image"><span>&nbsp;</span></a>
                                                </div>
                                            </div>
                                            <div class="mar-top-10">
                                                <button type="submit" class="btn green">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END CHANGE AVATAR TAB -->
                                    <!-- CHANGE PASSWORD TAB -->
                                    <div class="tab-pane" id="tab_1_3">
                                        <form class="js-validate-form-change-password" method="POST" accept-charset="utf-8" action="" novalidate>
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label><b>New password <span class="text-danger">(*)</span></b></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-lock"></i>
                                                    </span>
                                                    <input type="password" class="form-control" value="" name="password"
                                                           autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="mar-top-10">
                                                <button type="submit" class="btn green">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END CHANGE PASSWORD TAB -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PROFILE CONTENT -->
        </div>
    </div>
@endsection
