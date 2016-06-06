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
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <div class="form-horizontal form-bordered">
                <div class="form-body">
                    <div class="form-group">
                        <div class="col-md-3 text-right">Subject</div>
                        <div class="col-md-7">
                            {{ $object->subject or '' }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 text-right">Name</div>
                        <div class="col-md-7">
                            {{ $object->name or '' }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 text-right">Phone</div>
                        <div class="col-md-7">
                            {{ $object->phone or '' }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 text-right">Email</div>
                        <div class="col-md-7">
                            {{ $object->email or '' }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 text-right">Content</div>
                        <div class="col-md-7">
                            {!! $object->content or '' !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- END FORM-->
        </div>
    </div>
@endsection
