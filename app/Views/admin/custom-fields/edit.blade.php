@extends('admin._master')

@section('page-toolbar')

@endsection

@section('css')
    <link rel="stylesheet" href="/admin/dist/custom-fields.css">
@endsection

@section('js')
    <script type="text/javascript" src="/admin/dist/pages/custom-fields.js"></script>
@endsection

@section('js-init')
    <script type="text/javascript">
        $(document).ready(function(){
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
                        required: true
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
                    <textarea name="custom_fields_rules" id="custom_fields_rules" class="form-control hidden" style="display: none !important;">{!! ((isset($object)) ? $object->field_rules : '[]') !!}</textarea>
                    <textarea name="group_items" id="nestable-output" class="form-control hidden" style="display: none !important;"></textarea>
                    <textarea name="deleted_items" id="deleted_items" class="form-control hidden" style="display: none !important;"></textarea>
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-note font-dark"></i>
                                    <span class="caption-subject font-dark sbold uppercase">Basic information</span>
                                </div>
                                <div class="actions">
                                    <div class="btn-group btn-group-devided">
                                        <button class="btn btn-transparent btn-success btn-circle btn-sm active" type="submit">
                                            <i class="fa fa-check"></i> Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="form-group">
                                    <label><b>Title <span class="text-danger">(*)</span></b></label>
                                    <input required type="text" name="title" class="form-control" value="{{ $object->title or '' }}" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-md-12">
                    @if(isset($currentID) && $currentID > 0)
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-note font-dark"></i>
                                    <span class="caption-subject font-dark sbold uppercase">Rules</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row custom-fields-rules">
                                    <div class="col-xs-4 col-md-3">
                                        <p><b>Rules</b></p>
                                        Create a set of rules to determine which edit screens will use these custom fields
                                    </div>
                                    <div class="col-xs-8 col-md-9">
                                        <p><b>Show this field group if</b></p>
                                        <div class="line-group-container">
                                            {!! $rulesHtml or '' !!}
                                        </div>
                                        <div class="line">
                                            <p class="mar-top-10"><b>Or</b></p>
                                            <a class="location-add-rule-or location-add-rule btn btn-primary" href="#">Add rule group</a>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-note font-dark"></i>
                                <span class="caption-subject font-dark sbold uppercase">Field items</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="custom-fields-list">
                                <div class="nestable-group">
                                    <div class="add-new-field">
                                        <ul class="list-group field-table-header">
                                            <li class="col-xs-4 list-group-item w-bold">Field Label</li>
                                            <li class="col-xs-4 list-group-item w-bold">Field Name</li>
                                            <li class="col-xs-4 list-group-item w-bold">Field Type</li>
                                            <li class="clearfix"></li>
                                        </ul>
                                        <div class="clearfix"></div>
                                        {!! $sortableFieldHtml or '' !!}
                                        <div class="text-right">
                                            <a class="btn red btn-add-field" title="" href="#nestable > .dd-list">Add field</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
