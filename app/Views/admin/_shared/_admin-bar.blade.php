<nav class="navbar navbar-inverse navbar-fixed-top" id="headerAdminBar">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target=".navbar-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/{{ $adminCpAccess }}">
                <img src="/admin/theme/images/logo.png" alt="logo" class="logo-default"/>
            </a>
        </div>
        <div class="navbar-collapse collapse navbar-responsive-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="/{{ $adminCpAccess }}" data-target="#" class="dropdown-toggle"
                       data-toggle="dropdown">Appearance
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a target="_blank" href="/{{ $adminCpAccess }}/menus">
                                Menus
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="/{{ $adminCpAccess }}/settings">
                                Settings
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="/{{ $adminCpAccess }}/settings/languages">
                                Languages
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="/{{ $adminCpAccess }}" data-target="#" class="dropdown-toggle"
                       data-toggle="dropdown">Add new
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a target="_blank" href="/{{ $adminCpAccess }}/pages/edit/0/{{ $currentLanguageId }}">
                                Page
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="/{{ $adminCpAccess }}/posts/edit/0/{{ $currentLanguageId }}">
                                Post
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="/{{ $adminCpAccess }}/categories/edit/0/{{ $currentLanguageId }}">
                                Category
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="/{{ $adminCpAccess }}/products/edit/0/{{ $currentLanguageId }}">
                                Product
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="/{{ $adminCpAccess }}/product-categories/edit/0/{{ $currentLanguageId }}">
                                Product category
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a target="_blank" href="/{{ $adminCpAccess }}/users/edit/0">
                                User
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="/{{ $adminCpAccess }}/admin-users/edit/0">
                                Admin user
                            </a>
                        </li>
                    </ul>
                </li>
                @if(isset($currentFrontEditLink) && sizeof($currentFrontEditLink) > 0)
                    <li>
                        <a target="_blank" href="{{ $currentFrontEditLink['link'] or '' }}" title="{{ $currentFrontEditLink['title'] or '' }}">
                            {{ $currentFrontEditLink['title'] or '' }}
                        </a>
                    </li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="/{{ $adminCpAccess }}" data-target="#" class="dropdown-toggle"
                       data-toggle="dropdown">{{ $loggedInAdminUser->username }}
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a target="_blank" href="/{{ $adminCpAccess }}/admin-users/edit/{{ $loggedInAdminUser->id }}">
                                Change your password
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="/{{ $adminCpAccess }}/auth/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>