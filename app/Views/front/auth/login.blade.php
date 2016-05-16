@extends('front._master')

@section('css')

@endsection

@section('js')

@endsection

@section('js-init')

@endsection

@section('content')
    <a href="/{{ $currentLanguageCode }}/auth/logout">Sign out</a>
    <form action="/{{ $currentLanguageCode }}/auth/login" method="POST">
        {!! csrf_field() !!}
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="text" name="password" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Login</button>
        </div>
    </form>
@endsection