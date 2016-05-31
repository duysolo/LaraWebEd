@extends('admin._master')

@section('page-toolbar')

@endsection

@section('css')
    <link rel="stylesheet" href="/admin/core/third_party/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
@endsection

@section('js')
    <script type="text/javascript" src="/admin/core/third_party/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
@endsection

@section('js-init')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.js-date-time-picker').datetimepicker({
                autoclose: true
            });
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
                    value: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    total_quantity: {
                        required: true,
                        number: true,
                        min: -1
                    },
                    each_user_can_use: {
                        required: true,
                        number: true,
                        min: -1
                    },
                    apply_for_min_price: {
                        required: true,
                        number: true,
                        min: 0
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

            </div>
        </div>
    </div>
    <form accept-charset="utf-8" novalidate action="" method="POST" class="js-validate-form">
        {!! csrf_field() !!}
        <div class="portlet light form-fit bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-pin"></i>
                    <span class="caption-subject sbold uppercase">{{ $object->global_title or '' }}</span>
                </div>
                <div class="actions">
                    <!--div class="btn-group btn-group-devided">
                        <button type="submit" class="btn btn-circle green font-white btn-default btn-sm">
                            <i class="fa fa-check"></i> Update
                        </button>
                    </div-->
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <div class="form-horizontal form-bordered">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Coupon title <span class="text-danger">(*)</span></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" autocomplete="off" value="{{ $object->title or '' }}" name="title"/>
                                <span class="help-block">Title of this coupon</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Coupon code <span class="text-danger">(*)</span></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control bold font-red" autocomplete="off" readonly value="{{ $object->coupon_code or '' }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Language</label>
                            <div class="col-md-7">
                                <select name="language_id" class="form-control">
                                    @foreach($activatedLanguages as $key => $row)
                                        <option value="{{ $row->id }}" {{ (isset($object->language_id) && $object->language_id == $row->id) ? 'selected' : '' }}>{{ $row->language_name }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">Language of this coupon</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Currency</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control bold font-red" autocomplete="off" disabled value="{{ $object->language->currency or '' }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Status</label>
                            <div class="col-md-7">
                                <select name="status" class="form-control">
                                    <option value="1" {{ (isset($object) && $object->status == 1) ? 'selected' : '' }}>Published</option>
                                    <option value="0" {{ (isset($object) && $object->status == 0) ? 'selected' : '' }}>Disabled</option>
                                    <option value="2" {{ (isset($object) && $object->status == 2) ? 'selected' : '' }}>Expired</option>
                                </select>
                                <span class="help-block">Status of this coupon</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Expired at</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control js-date-time-picker" data-date-format="yyyy-mm-dd hh:ii:ss" readonly autocomplete="off" value="{{ $object->expired_at or date('Y-m-d H:i:s') }}" name="expired_at"/>
                                <span class="help-block">Coupon will be expired on this day.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Coupon type</label>
                            <div class="col-md-7">
                                <div class="md-radio-list">
                                    <div class="md-radio">
                                        <input type="radio"
                                               id="coupon_type_percentage"
                                               value="0"
                                               {{ (!isset($object) || !$object || $object->type != 1) ? 'selected checked' : '' }}
                                               name="type"
                                               class="md-radiobtn">
                                        <label for="coupon_type_percentage">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> Percentage
                                        </label>
                                    </div>
                                    <div class="md-radio">
                                        <input type="radio"
                                               id="coupon_type_fixed"
                                               value="1"
                                               {{ (isset($object) && $object && $object->type == 1) ? 'selected checked' : '' }}
                                               name="type"
                                               class="md-radiobtn">
                                        <label for="coupon_type_fixed">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> Fixed price
                                        </label>
                                    </div>
                                </div>
                                <span class="help-block">Type of this coupon (fixed price or percentage)</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Coupon value <span class="text-danger">(*)</span></label>
                            <div class="col-md-7">
                                <input type="number" class="form-control" autocomplete="off" value="{{ $object->value or 0 }}" name="value"/>
                                <span class="help-block">Value of this coupon</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Total quantity <span class="text-danger">(*)</span></label>
                            <div class="col-md-7">
                                <input type="number" class="form-control" autocomplete="off" value="{{ $object->total_quantity or 0 }}" name="total_quantity"/>
                                <span class="help-block">Quantity of this coupon</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Total used</label>
                            <div class="col-md-7">
                                <span class="help-block">This coupon has been used <b class="font-red">{{ $object->total_used or 0 }}</b> time(s).</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Each user can use</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control input-small" autocomplete="off" value="{{ $object->each_user_can_use or 1 }}" name="each_user_can_use"/>
                                <span class="help-block">How many times each user can use this coupon?</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Apply for orders with min price</label>
                            <div class="col-md-7">
                                <input type="number" class="form-control" autocomplete="off" value="{{ $object->apply_for_min_price or 0 }}" name="apply_for_min_price"/>
                                <span class="help-block">This coupon can applied only for orders with this min price</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Coupon image</label>
                            <div class="col-md-7">
                                <div class="select-media-box">
                                    <button type="button" class="btn blue show-add-media-popup">Choose image</button>
                                    <div class="clearfix"></div>
                                    <a title="" class="show-add-media-popup"><img src="{{ (isset($object) && trim($object->thumbnail != '')) ? $object->thumbnail : '/admin/images/no-image.png' }}" alt="Thumbnail" class="img-responsive"></a>
                                    <input type="hidden" name="thumbnail" value="{{ $object->thumbnail or '' }}" class="input-file">
                                    <a title="" class="remove-image"><span>&nbsp;</span></a>
                                </div>
                                <span class="help-block">Thumbnail image for this coupon</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END FORM-->
            </div>
            <div class="text-right" style="padding: 15px;">
                <button type="submit" class="btn btn-circle green font-white btn-default">
                    <i class="fa fa-check"></i> Update
                </button>
            </div>
        </div>
    </form>
@endsection
