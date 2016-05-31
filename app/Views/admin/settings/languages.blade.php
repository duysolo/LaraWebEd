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
        $(document).ready(function(){
            TableDatatablesAjax.init({
                ajaxGet: '{{ asset($adminCpAccess.'/settings/languages') }}',
                src: $('#datatable_ajax'),
                onSuccess: function(grid, response){

                },
                onError: function(grid){

                },
                onDataLoad: function(grid){

                },
                editableFields: [2, 3, 4, 5],
                actionPosition: 7,
                ajaxUrlSaveRow: '{{ asset($adminCpAccess.'/settings/fast-edit-languages') }}'
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

            <!-- Begin: life time stats -->
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-layers font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">All languages</span>
                    </div>
                    <div class="actions">

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
                        <table class="table table-striped table-bordered table-hover table-checkable vertical-middle" id="datatable_ajax">
                            <thead>
                            <tr role="row" class="heading">
                                <th width="1%">
                                    <input type="checkbox" class="group-checkable">
                                </th>
                                <th width="5%">
                                    #
                                </th>
                                <th width="40%">Name</th>
                                <th width="10%">Code</th>
                                <th width="10%">Locale</th>
                                <th width="10%">Currency</th>
                                <th width="10%">Status</th>
                                <th width="10%">Fast edit</th>
                            </tr>
                            <tr role="row" class="filter">
                                <td></td>
                                <td></td>
                                <td>
                                    <input placeholder="Search..." type="text" class="form-control form-filter input-sm" name="language_name">
                                </td>
                                <td>
                                    <input placeholder="Search..." type="text" class="form-control form-filter input-sm" name="language_code">
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <select class="form-control form-filter input-small input-sm" name="status">
                                        <option value="">Select...</option>
                                        <option value="1">Activated</option>
                                        <option value="0">Disabled</option>
                                    </select>
                                </td>
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
            <!-- End: life time stats -->
        </div>
    </div>
@endsection
