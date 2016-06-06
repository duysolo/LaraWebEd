@extends('admin._master')

@section('page-toolbar')

@endsection

@section('css')

@endsection

@section('js')

@endsection

@section('js-init')
    <script type="text/javascript">
        $(document).ready(function(){

        });
    </script>
@endsection

@section('content')
    <div class="portlet light form-fit bordered">
        @if(isset($object) && !$object->parent_id)
            <div class="portlet-title">
                <div class="actions btn-set">
                    <a type="button" href="/{{ $adminCpAccess }}/comments/reply/{{ $object->id }}" class="btn btn-secondary-outline default">
                        <i class="fa fa-reply"></i> Reply
                    </a>
                </div>
            </div>
        @else
            <div class="portlet-title">
                <div class="caption">
                    Comment reply for <a href="/{{ $adminCpAccess }}/comments/edit/{{ $object->parent_id }}">#{{ $object->parent_id }}</a>
                </div>
            </div>
        @endif
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form class="form-horizontal form-bordered" action="" method="POST" accept-charset="UTF-8">
                {!! csrf_field() !!}
                <div class="form-body">
                    <div class="form-group">
                        <div class="col-md-3 text-right">Title</div>
                        <div class="col-md-7">
                            <input class="form-control" type="text" name="title" value="{{ $object->title or '' }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 text-right">Name</div>
                        <div class="col-md-7">
                            <input class="form-control" type="text" name="name" value="{{ $object->name or '' }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 text-right">Phone</div>
                        <div class="col-md-7">
                            <input class="form-control" type="text" name="phone" value="{{ $object->phone or '' }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 text-right">Email</div>
                        <div class="col-md-7">
                            <input class="form-control" type="text" name="email" value="{{ $object->email or '' }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 text-right">Status</div>
                        <div class="col-md-7">
                            <select name="status" class="form-control">
                                <option value="0" {{ $object->status != 1 ? 'selected=selected' : '' }}>Pending</option>
                                <option value="1" {{ $object->status == 1 ? 'selected=selected' : '' }}>Allowed</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 text-right">Content</div>
                        <div class="col-md-7">
                            <textarea name="content" rows="5" class="form-control">{!! $object->content or '' !!}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-push-3 col-md-7 text-right">
                            <button type="submit" class="btn btn-circle green font-white btn-default">
                                <i class="fa fa-check"></i> Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- END FORM-->
        </div>
    </div>
@endsection