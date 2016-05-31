<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <title>{{ $pageTitle or 'Login' }} | Admin dashboard</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="Admin dashboard - Tedozi CMS" name="description"/>
    <meta content="duyphan.developer@gmail.com" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="/admin/fonts/open-sans/font.css" rel="stylesheet">
    <link href="/admin/core/third_party/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="/admin/core/third_party/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="/admin/core/third_party/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/admin/core/third_party/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <link href="/admin/core/third_party/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="/admin/core/third_party/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
    <link href="/admin/core/third_party/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
    <link href="/admin/core/third_party/notific8/jquery.notific8.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- OTHER PLUGINS -->
    @yield('css')
    <!-- END OTHER PLUGINS -->

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="/admin/theme/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css"/>
    <link href="/admin/theme/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->

    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="/admin/theme/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css"/>
    <link href="/admin/theme/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="/admin/css/style.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME LAYOUT STYLES -->

    <link rel="shortcut icon" href="/admin/favicon.ico"/>

    <script type="text/javascript">
        var baseUrl = '{{ asset('') }}';
    </script>

    <!-- BEGIN CORE PLUGINS -->
    <script src="/admin/dist/core.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
</head>

<body class="page-header-fixed page-content-white login page-auth">

<!-- Loading state -->
<div class="page-spinner-bar">
    <div class="bounce1"></div>
    <div class="bounce2"></div>
    <div class="bounce3"></div>
</div>
<!-- Loading state -->

<div class="menu-toggler sidebar-toggler"></div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="/">
        <img src="/admin/theme/images/logo.png" alt="" /> </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    @yield('content')
</div>
<div class="copyright">2015 &copy; LaraWebEd. All rights reserved.</div>


<!--[if lt IE 9]>
<script src="/admin/core/third_party/respond.min.js"></script>
<script src="/admin/core/third_party/excanvas.min.js"></script>
<![endif]-->

<!-- OTHER PLUGINS -->
@yield('js')
<!-- END OTHER PLUGINS -->

<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/admin/theme/assets/global/scripts/app.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/admin/dist/app.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!-- JS INIT -->
@yield('js-init')
<!-- JS INIT -->

@include('admin/_shared/_flash-messages')

</body>

</html>
