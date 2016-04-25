@extends('front._master')

@section('css')

@endsection

@section('js')

@endsection

@section('js-init')

@endsection

@section('content')
    @include('front/_shared/_sidebar-left')
    <div class="main-content">
        {!! $object->content !!}
    </div>
@endsection