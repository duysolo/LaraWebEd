$(document).ready(function(){
    "use strict";

    /*Detect IE*/
    Utility.detectIE(function(){
        /*Callback*/
    });

    /*Add csrf token to ajax request*/
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /*Sortable content*/
    $(".sortable-wrapper").sortable();
    $('.disable-sortable').sortable('destroy');

    /*Change content language*/
    Utility.changeContentLanguage();

    /*Handle select media box*/
    Utility.handleSelectMediaBox();
});

$(window).load(function () {
    "use strict";
    /*Hide loading state*/
    Utility.hideLoading();
});
