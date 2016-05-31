<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{ asset($adminCpAccess) }}">Admin panel</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>{{ $pageTitle or 'Admin panel' }}</span>
        </li>
    </ul>
    <div class="page-toolbar">
        @yield('page-toolbar')
    </div>
</div>
<!-- END PAGE BAR -->

<!-- BEGIN PAGE TITLE-->
<h3 class="page-title"> {{ $pageTitle or 'Admin panel' }}
    <small>{{ $subPageTitle or '' }}</small>
</h3>
<!-- END PAGE TITLE-->
