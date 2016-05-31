
<!DOCTYPE html>
<!--[if IE 8]>
<html lang="{{ $currentLanguageCode or 'en' }}" class="ie8 no-js {{ ($showHeaderAdminBar) ? 'show-admin-bar' : '' }}"> <![endif]-->
<!--[if IE 9]>
<html lang="{{ $currentLanguageCode or 'en' }}" class="ie9 no-js {{ ($showHeaderAdminBar) ? 'show-admin-bar' : '' }}"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ $currentLanguageCode or 'en' }}" class="{{ ($showHeaderAdminBar) ? 'show-admin-bar' : '' }}">
<!--<![endif]-->
<head>
    @include('front/_shared/_metas')

    <!-- GLOBAL PLUGINS -->
    {{--<link rel="stylesheet" href="/fonts/Open-Sans/font.css">--}}
    <!-- GLOBAL PLUGINS -->

    <!-- OTHER PLUGINS -->
    @yield('css')
    <!-- END OTHER PLUGINS -->

    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="/css/style.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME LAYOUT STYLES -->

    @if($showHeaderAdminBar)
        <link rel="stylesheet" href="/admin/css/admin-bar.css">
    @endif

    <link rel="shortcut icon" href="/images/logo/favicon.png"/>

    {!! $CMSSettings['google_analytics'] or '' !!}
</head>

<body class="on-loading {{ $bodyClass or '' }}">

@if($showHeaderAdminBar)
    @include('admin/_shared/_admin-bar')
@endif

<div class="site-wrapper">
    <header class="header">
        @include('front/_shared/_header')
    </header>

    <main class="main">
        @yield('content')
    </main>

    <footer class="footer">
        @include('front/_shared/_footer')
    </footer>
</div>

<!--Modals-->
@include('front/_shared/_modals')

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!--Google captcha-->
@include('front/_shared/_google-captcha')
<!--Google captcha-->

<!-- BEGIN CORE PLUGINS -->
<script src="/dist/core.min.js"></script>
<!-- END CORE PLUGINS -->

<!-- OTHER PLUGINS -->
@yield('js')
<!-- END OTHER PLUGINS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/dist/app.min.js"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!-- JS INIT -->
@yield('js-init')
<!-- JS INIT -->

@include('front/_shared/_flash-messages')

</body>

</html>