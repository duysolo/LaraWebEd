<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CMS File Browser</title>

    <link rel="stylesheet" href="/admin/core/third_party/jquery-ui/jquery-ui.min.css"/>

    <!-- elFinder CSS (REQUIRED) -->
    <link rel="stylesheet" type="text/css" href="/admin/core/barryvdh/elfinder/css/elfinder.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/core/barryvdh/elfinder/css/theme.css">
</head>
<body>
    <!-- Element where elFinder will be created (REQUIRED) -->
    <div id="elfinder"></div>

    <!-- jQuery and jQuery UI (REQUIRED) -->
    <script src="/admin/core/third_party/jquery.min.js"></script>
    <script src="/admin/core/third_party/jquery-ui/jquery-ui.min.js"></script>

    <!-- elFinder JS (REQUIRED) -->
    <script src="/admin/core/barryvdh/elfinder/js/elfinder.min.js"></script>

    <script type="text/javascript" charset="utf-8">
        var baseUrl = '{{ asset('') }}';
        var selectMethod = '{{ Request::get('method', 'standalone') }}';
        var fileType = '{{ Request::get('type', 'image') }}';
        var funcNum = '{{ Request::get('CKEditorFuncNum') }}';

        function getUrlParam(paramName) {
            var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i');
            var match = window.location.search.match(reParam);

            return (match && match.length > 1) ? match[1] : '';
        }

        $(document).ready(function () {
            $('#elfinder').elfinder({
                // set your elFinder options here
                customData: {
                    _token: '{{ csrf_token() }}'
                },
                url: '{{ $url }}',
                @if(Request::get('type', 'image') != 'file')
                onlyMimes: ["image"],
                @endif
                getFileCallback: function (file) {
                    var URL = file.url.replace(baseUrl, '/');
                    if (selectMethod == "ckeditor") {
                        window.opener.CKEDITOR.tools.callFunction(funcNum, URL);
                        window.close();
                    }
                    if (selectMethod == 'standalone') {
                        $modal = window.parent.document.mediaModal;
                        $target = window.parent.document.currentMediaBox;
                        if (fileType == 'file') {
                            $target.find('a .title').html(URL);
                        }
                        else {
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
</body>
</html>
