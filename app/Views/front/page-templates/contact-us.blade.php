@extends('front._master')

@section('css')

@endsection

@section('js')

@endsection

@section('js-init')

@endsection

@section('content')
    <h1>{{ $object->title }}</h1>
    <h1>Contact us template</h1>

    @include('front._modules._contact-us')
@endsection
