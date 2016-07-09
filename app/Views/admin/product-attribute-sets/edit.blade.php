@extends('admin._master')

@section('page-toolbar')

@endsection

@section('css')

@endsection

@section('js')
    <script src="/admin/theme/assets/global/scripts/datatable.js"></script>
    <script src="/admin/theme/assets/global/plugins/datatables/datatables.min.js"></script>
    <script src="/admin/theme/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"></script>
@endsection

@section('js-init')
    <script src="/admin/dist/pages/table-datatables-ajax.js"></script>
    <script>
        $(document).ready(function () {
            @if(isset($object->id) && $object->id)
                TableDatatablesAjax.init({
                ajaxGet: '{{ asset($adminCpAccess.'/product-attribute-sets/details/'.$object->id) }}',
                src: $('#datatable_ajax'),
                onSuccess: function (grid, response) {

                },
                onError: function (grid) {

                },
                onDataLoad: function (grid) {

                },
                editableFields: [1, 2, 3, 4],
                actionPosition: 5,
                ajaxUrlSaveRow: '{{ asset($adminCpAccess.'/product-attribute-sets/fast-edit-attribute/'.$object->id) }}'
            });
            @endif

            Utility.convertTitleToSlug('.the-object-title', '.the-object-slug');

            $('.js-validate-form').validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {},
                rules: {
                    title: {
                        minlength: 1,
                        maxlength: 255,
                        required: true
                    },
                    slug: {
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
                        <span class="caption-subject font-dark sbold uppercase">Basic information</span>
                    </div>
                </div>
                <div class="portlet-body clearfix">
                    <div class="row">
                        <form class="js-validate-form" method="POST" accept-charset="utf-8" action="" novalidate>
                            <div class="col-md-6">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label><b>Title <span class="text-danger">(*)</span></b></label>
                                    <input required type="text" name="title" class="form-control the-object-title"
                                           value="{{ $object->title or '' }}" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label><b>Alias <span class="text-danger">(*)</span></b></label>
                                    <input type="text" name="slug" class="form-control the-object-slug"
                                           value="{{ $object->slug or '' }}" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label><b>Status</b></label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{ (isset($object) && $object->status == 1) ? 'selected' : '' }}>
                                            Published
                                        </option>
                                        <option value="0" {{ (isset($object) && $object->status == 0) ? 'selected' : '' }}>
                                            Disabled
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group mar-bot-0">
                                    <button class="btn btn-transparent btn-success active btn-circle" type="submit">
                                        <i class="fa fa-check"></i> Save
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(isset($categoriesHtml) && trim($categoriesHtml) != '')
                                    <div class="form-group">
                                        <label><b>Visible on these product categories:</b></label>
                                        <div class="form-control height-auto">
                                            <div class="scroller" style="max-height: 300px;" data-always-visible="1"
                                                 data-rail-visible1="1">
                                                {!! $categoriesHtml or '' !!}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Begin: life time stats -->
            @if(isset($object->id) && $object->id)
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-layers font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">Related attributes</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided">
                                <a class="btn btn-transparent btn-success btn-circle btn-sm active btn-create"
                                   href="{{ asset($adminCpAccess.'/product-attribute-sets/edit-attribute/'.$object->id.'/0') }}">
                                    <i class="fa fa-plus"></i> Create
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <div class="table-actions-wrapper">
                                <span></span>
                                <select class="table-group-action-input form-control input-inline input-small input-sm">
                                    <option value="">Select...</option>
                                    <option value="1">Activated</option>
                                    <option value="0">Disabled</option>
                                </select>
                                <button class="btn btn-sm green table-group-action-submit" data-toggle="confirmation">
                                    <i class="fa fa-check"></i> Submit
                                </button>
                            </div>
                            <table class="table table-striped table-bordered table-hover table-checkable vertical-middle"
                                   id="datatable_ajax">
                                <thead>
                                <tr role="row" class="heading">
                                    <th width="1%">
                                        <input type="checkbox" class="group-checkable">
                                    </th>
                                    <th width="15%">Name</th>
                                    <th width="15%">Slug</th>
                                    <th width="15%">Value</th>
                                    <th width="5%">Order</th>
                                    <th width="10%">Fast edit</th>
                                    <th width="10%">Actions</th>
                                </tr>
                                <tr role="row" class="filter">
                                    <td></td>
                                    <td>
                                        <input placeholder="Search..." type="text"
                                               class="form-control form-filter input-sm"
                                               name="name">
                                    </td>
                                    <td>
                                        <input placeholder="Search..." type="text"
                                               class="form-control form-filter input-sm"
                                               name="slug">
                                    </td>
                                    <td>
                                        <input placeholder="Search..." type="text"
                                               class="form-control form-filter input-sm"
                                               name="value">
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <button class="btn btn-sm btn-success filter-submit margin-bottom">
                                            <i class="fa fa-search"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning filter-cancel">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
        @endif
        <!-- End: life time stats -->
        </div>
    </div>
@endsection
