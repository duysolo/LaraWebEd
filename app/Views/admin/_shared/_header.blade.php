<!-- BEGIN HEADER INNER -->
<div class="page-header-inner ">
    <!-- BEGIN LOGO -->
    <div class="page-logo">
        <a href="/{{ $defaultLanguage->language_code or '' }}">
            <img src="/admin/theme/images/logo.png" alt="logo" class="logo-default"/>
        </a>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
    <!-- END RESPONSIVE MENU TOGGLER -->

    <!-- BEGIN TOP NAVIGATION MENU -->
    <div class="top-menu">
        <ul class="nav navbar-nav pull-right">
            @if(isset($unreadMailCount) && $unreadMailCount)
                <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                    <a title="You have {{ $unreadMailCount }} unread mail(s) in inbox" href="{{ '/'.$adminCpAccess.'/contacts' }}" class="dropdown-toggle" style="padding-right: 10px;">
                        <i class="icon-envelope-open"></i>
                        <span class="badge badge-default">{{ $unreadMailCount }}</span>
                    </a>
                </li>
            @endif
            <li class="dropdown dropdown-extended dropdown-user dropdown-dark dropdown-notification" id="header_notification_bar">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <span class="username"><i class="fa fa-plus"></i> Add new</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-default">
                    <li>
                        <a href="/{{ $adminCpAccess }}/pages/edit/0/{{ $defaultLanguageId }}">
                            <i class="fa fa-tasks"></i> Page
                        </a>
                    </li>
                    <li>
                        <a href="/{{ $adminCpAccess }}/posts/edit/0/{{ $defaultLanguageId }}">
                            <i class="icon-layers"></i> Post
                        </a>
                    </li>
                    <li>
                        <a href="/{{ $adminCpAccess }}/categories/edit/0/{{ $defaultLanguageId }}">
                            <i class="fa fa-sitemap"></i> Category
                        </a>
                    </li>
                    <li>
                        <a href="/{{ $adminCpAccess }}/products/edit/0/{{ $defaultLanguageId }}">
                            <i class="fa fa-cubes"></i> Product
                        </a>
                    </li>
                    <li>
                        <a href="/{{ $adminCpAccess }}/product-categories/edit/0/{{ $defaultLanguageId }}">
                            <i class="fa fa-sitemap"></i> Product category
                        </a>
                    </li>
                    <li>
                        <a href="/{{ $adminCpAccess }}/coupons/edit/0/{{ $defaultLanguageId }}">
                            <i class="fa fa-code"></i> Coupon
                        </a>
                    </li>
                    <li>
                        <a href="/{{ $adminCpAccess }}/brands/edit/0">
                            <i class="fa fa-umbrella"></i> Brands
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="/{{ $adminCpAccess }}/custom-fields/edit/0">
                            <i class="fa fa-edit"></i> Custom field
                        </a>
                    </li>
                    <li>
                        <a href="/{{ $adminCpAccess }}/users/edit/0">
                            <i class="icon-users"></i> User
                        </a>
                    </li>
                    <li>
                        <a href="/{{ $adminCpAccess }}/admin-users/edit/0">
                            <i class="icon-users"></i> Admin user
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown dropdown-user dropdown-dark">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <img alt="" class="img-circle" src="/admin/theme/assets/layouts/layout/img/avatar3_small.jpg">
                    <span class="username username-hide-on-mobile">{{ $loggedInAdminUser->username }}</span>
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-default">
                    <li>
                        <a href="/{{ $adminCpAccess }}/admin-users/edit/{{ $loggedInAdminUser->id }}">
                            <i class="icon-key"></i> Change password
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="/{{ $adminCpAccess.'/auth/logout' }}">
                            <i class="icon-logout"></i> Log Out
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- END TOP NAVIGATION MENU -->
</div>
<!-- END HEADER INNER -->
