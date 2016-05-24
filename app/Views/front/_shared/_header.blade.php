<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                <span>{{ $CMSSettings['site_title'] or '' }}</span>
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            {!! $CMSMenuHtml or '' !!}
            <ul class="nav navbar-nav navbar-right">
                @if(isset($loggedInUser))
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true">{{ $loggedInUser->getUserName() }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Welcome to our site</li>
                            <li><a href="/{{ $currentLanguageCode }}/user/my-account">My account</a></li>
                            <li><a href="/{{ $currentLanguageCode }}/user/password">Change password</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/{{ $currentLanguageCode.'/auth/logout' }}">Logout</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="/{{ $currentLanguageCode }}/auth/login">Login</a></li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right languages">
                @foreach($activatedLanguages as $key => $row)
                    <li class="">
                        <a class="" href="/{{ $row->language_code or '' }}" title="{{ $row->language_name or '' }}">
                            <img src="/images/flags/{{ $row->language_code or 'en' }}.png" alt="{{ $row->language_name or '' }}" class="img-responsive">
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>