<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CMS File Browser</title>

    <!-- jQuery and jQuery UI (REQUIRED) -->
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

    <!-- elFinder CSS (REQUIRED) -->
    <link rel="stylesheet" type="text/css" href="{{ asset($dir.'/css/elfinder.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset($dir.'/css/theme.css') }}">

    <!-- elFinder JS (REQUIRED) -->
    <script src="{{ asset($dir.'/js/elfinder.min.js') }}"></script>

    @if($locale)
            <!-- elFinder translation (OPTIONAL) -->
    <script src="{{ asset($dir."/js/i18n/elfinder.$locale.js") }}"></script>
    @endif

    <script type="text/javascript" charset="utf-8">
        var baseUrl = '{{ asset('') }}';
        var selectMethod = '{{ Request::get('method', 'standalone') }}';
        var fileType = '{{ Request::get('type', 'image') }}';
        var funcNum = '{{ Request::get('CKEditorFuncNum') }}';

        function getUrlParam(paramName) {
            var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i') ;
            var match = window.location.search.match(reParam) ;

            return (match && match.length > 1) ? match[1] : '' ;
        }

        $(document).ready(function() {
            $('#elfinder').elfinder({
                // set your elFinder options here
                @if($locale)
                lang: '{{ $locale }}',
                @endif
                customData: {
                    _token: '{{ csrf_token() }}'
                },
                url : '{{ $url }}',
                @if(Request::get('type', 'image') != 'file')
                onlyMimes: ["image"],
                @endif
                getFileCallback: function (file) {
                    var URL = file.url.replace(baseUrl, '/');
                    if(selectMethod == "ckeditor")
                    {
                        window.opener.CKEDITOR.tools.callFunction(funcNum, URL);
                        window.close();
                    }
                    if(selectMethod == 'standalone')
                    {
                        $modal = window.parent.document.mediaModal;
                        $target = window.parent.document.currentMediaBox;
                        if(fileType == 'file')
                        {
                            $target.find('a .title').html(URL);
                        }
                        else
                        {
                            $target.find('.img-responsive').attr('src', URL);
                        }

                        $target.find('.input-file').val(URL);
                        $modal.find('iframe').remove();
                        $modal.modal('hide');
                    }
                }
            });
        });
    </script>
</head>
<body>

<!-- Element where elFinder will be created (REQUIRED) -->
<div id="elfinder"></div>

</body>
</html>
