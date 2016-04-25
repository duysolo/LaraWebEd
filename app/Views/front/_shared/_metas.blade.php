<meta charset="utf-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-language" content="{{ $currentLanguageCode or 'en' }}"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ $pageTitle or '' }} | {{ $CMSSettings['site_title'] or '' }}</title>
<meta name="description" content="{{ $metaSEO['description'] or '' }}"/>
<meta name="keywords" content="{{ $metaSEO['keywords'] or '' }}"/>
<meta content="duyphan.developer@gmail.com | https://github.com/duyphan2502" name="author"/>

<!-- Google+ -->
<meta itemprop="name" content="{{ $pageTitle or '' }} | {{ $CMSSettings['site_title'] or '' }}">
<meta itemprop="description" content="{{ $metaSEO['description'] or '' }}">
<meta itemprop="keywords" content="{{ $metaSEO['keywords'] or '' }}">
<meta itemprop="image" content="{{ $metaSEO['image'] or '' }}">

<!-- Twitter Card data -->
<meta name="twitter:card" content="{{ $metaSEO['image'] or '' }}">
<meta name="twitter:site" content="{{ Request::url() }}">
<meta name="twitter:title" content="{{ $pageTitle or '' }} | {{ $CMSSettings['site_title'] or '' }}">
<meta name="twitter:description" content="{{ $metaSEO['description'] or '' }}">
<meta name="twitter:creator" content="Tedozi Manson - duyphan.developer@gmail.com - 0915428202">
<!-- Twitter summary card with large image must be at least 280x150px -->
<meta name="twitter:image:src" content="{{ $metaSEO['image'] or '' }}">

<!-- Open Graph data -->
<meta property="og:title" content="{{ $pageTitle or '' }} | {{ $CMSSettings['site_title'] or '' }}"/>
<meta property="og:type" content="article"/>
<meta property="og:url" content="{{ Request::url() }}"/>
<meta property="og:image" content="{{ $metaSEO['image'] or '' }}"/>
<meta property="og:description" content="{{ $metaSEO['description'] or '' }}"/>
<meta property="og:site_name" content="{{ $CMSSettings['site_title'] or '' }}"/>
<meta property="article:published_time"
      content="{{ (isset($object) && isset($object->created_at)) ? $object->created_at->toDatetimeString() : date('Y-m-d H:i:s') }}"/>
<meta property="article:modified_time"
      content="{{ (isset($object) && isset($object->updated_at)) ? $object->updated_at->toDatetimeString() : date('Y-m-d H:i:s') }}"/>
<meta property="article:section" content="{{ $pageTitle or $CMSSettings['site_title'] }}"/>
<meta property="article:tag" content="{{ $metaSEO['keywords'] or '' }}"/>
<meta property="fb:admins" content=""/>