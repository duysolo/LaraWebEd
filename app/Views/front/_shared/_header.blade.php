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
                <img src="/images/logo/laravel-logo.png" alt="{{ $CMSSettings['site_title'] or '' }}">
                <span>{{ $CMSSettings['site_title'] or '' }}</span>
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            {!! $CMSMenuHtml or '' !!}
            <ul class="nav navbar-nav navbar-right languages">
                @foreach($activatedLanguages as $key => $row)
                    <li class="">
                        <a class="" href="/{{ $row->language_code or '' }}" title="{{ $row->language_name or '' }}">
                            <img src="/images/flags/{{ $row->language_code or 'en' }}.png" alt="{{ $row->language_name or '' }}" class="img-responsive">
                        </a>
                    </li>
                @endforeach
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>