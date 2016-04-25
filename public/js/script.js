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
});

$(window).load(function () {
    "use strict";

    /*Hide loading state*/
    Utility.hideLoading();
});
