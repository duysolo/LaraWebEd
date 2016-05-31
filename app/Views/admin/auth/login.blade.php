@extends('admin.auth._auth-actions')

@section('js-init')
<script type="text/javascript" src="/admin/dist/pages/login.js"></script>
@endsection

@section('content')
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form active" action="" method="post" accept-charset="utf-8">
        {!! csrf_field() !!}
        <h3 class="form-title font-green">Login</h3>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" required autocomplete="off" placeholder="Username" name="username" />
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" required autocomplete="off" placeholder="Password" name="password" />
        </div>
        <div class="form-actions text-center">
            <button type="submit" class="btn green uppercase">
                <i class="fa fa-check"></i>
                Confirm
            </button>
        </div>
    </form>
    <!-- END LOGIN FORM -->
@endsection
