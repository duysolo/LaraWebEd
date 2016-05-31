@extends('admin._master')

@section('page-toolbar')

@endsection

@section('css')
    <link rel="stylesheet" href="/admin/core/third_party/jquery-nestable/jquery.nestable.css">
    <link rel="stylesheet" href="/admin/css/menu-nestable.css">
@endsection

@section('js')
    <script type="text/javascript" src="/admin/core/third_party/jquery-nestable/jquery.nestable.js"></script>
    <script type="text/javascript" src="/admin/dist/pages/menu-nestable.js"></script>
@endsection

@section('js-init')
    <script type="text/javascript">
        $(document).ready(function () {
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
                        required: true
                    },
                    slug: {
                        required: true,
                        minlength: 3
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
        $(window).load(function() {
            MenuNestable.init();
            MenuNestable.handleNestableMenu();
        });
    </script>
@endsection

@section('content')
    <form action="" accept-charset="utf-8" method="POST" class="js-validate-form form-save-menu clearfix">
        {{ csrf_field() }}
        <input type="hidden" name="deleted_nodes" value="">
        <textarea name="menu_nodes" id="nestable-output" class="form-control hidden" style="display: none !important;"></textarea>
        <div class="row">
            <div class="col-md-12">
                <div class="note note-danger">
                    <p><label class="label label-danger">NOTE</label> You need to enable javascript.</p>
                </div>
                <div class="note note-danger">
                    <p><label class="label label-danger">NOTE</label> <b>Edit menu structure</b> is supported in
                        Firefox, Chrome, Opera, Safari, Internet Explorer 10 and Internet Explorer 9 only. Internet
                        Explorer 8 and older not supported.</p>
                </div>
            </div>
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
                            <label>Menu title</label>
                            <input type="text" name="title" class="form-control the-object-title" value="{{ $object->title }}" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Menu name</label>
                            <input type="text" name="slug" class="form-control the-object-slug" value="{{ $object->slug }}" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label><b>Language</b></label>
                            <select name="language_id" data-href="{{ $rawUrlChangeLanguage }}" class="form-control js-change-content-language">
                                @foreach($activatedLanguages as $key => $row)
                                    <option value="{{ $row->id }}" {{ ($currentEditLanguage->id == $row->id) ? 'selected' : '' }}>{{ $row->language_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @if(isset($object) && $object->id)
    <div class="row">
        <div class="col-md-4">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-link font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Add link</span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="box-links-for-menu">
                        <div id="external_link" class="the-box">
                            <div class="form-group">
                                <label for="node-title" class="">Title</label>
                                <input type="text" required="" class="form-control" id="node-title" placeholder="" value="" name="" autocomplete="false">
                            </div>
                            <div class="form-group">
                                <label for="node-url" class="">Url</label>
                                <input type="text" required="" class="form-control" id="node-url" placeholder="http://" value="" name="" autocomplete="false">
                            </div>
                            <div class="form-group">
                                <label for="node-css" class="">CSS class</label>
                                <input type="text" required="" class="form-control" id="node-css" placeholder="" value="" name="" autocomplete="false">
                            </div>
                            <div class="text-right">
                                <div class="btn-group btn-group-devided">
                                    <a href="#" title="" class="btn-add-to-menu btn btn-success btn-sm btn-circle btn-transparent active"><span class="text"><i class="fa fa-plus"></i> Add to menu</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(isset($pages) && sizeof($pages) > 0)
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-link font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">Pages</span>
                        </div>
                        <div class="tools">
                            <a href="" class="collapse" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="box-links-for-menu">
                            <div class="the-box">
                                <ul class="list-item">
                                    @foreach ($pages as $key => $row)
                                        <li>
                                            <a href="#" data-type="page" data-relatedid="{{ $row->id }}" data-title="{{ $row->global_title }}">{{ $row->global_title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="text-right">
                                    <div class="btn-group btn-group-devided">
                                        <a href="#" title="" class="btn-add-to-menu btn btn-success btn-sm btn-circle btn-transparent active"><span class="text"><i class="fa fa-plus"></i> Add to menu</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($categories) && trim($categories) != '')
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-link font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">Categories</span>
                        </div>
                        <div class="tools">
                            <a href="" class="collapse" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="box-links-for-menu">
                            <div class="the-box">
                                {!! $categories or '' !!}
                                <div class="text-right">
                                    <div class="btn-group btn-group-devided">
                                        <a href="#" title="" class="btn-add-to-menu btn btn-success btn-sm btn-circle btn-transparent active"><span class="text"><i class="fa fa-plus"></i> Add to menu</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($productCategories) && trim($productCategories) != '')
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-link font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">Product categories</span>
                        </div>
                        <div class="tools">
                            <a href="" class="collapse" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="box-links-for-menu">
                            <div class="the-box">
                                {!! $productCategories or '' !!}
                                <div class="text-right">
                                    <div class="btn-group btn-group-devided">
                                        <a href="#" title="" class="btn-add-to-menu btn btn-success btn-sm btn-circle btn-transparent active"><span class="text"><i class="fa fa-plus"></i> Add to menu</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-md-8">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-bars font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Menu structure</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="dd nestable-menu" id="nestable" data-depth="0">
                        {!! $nestableMenuSrc or '' !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
