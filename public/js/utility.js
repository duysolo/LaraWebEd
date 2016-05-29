var Utility = function () {
    var $body = $('body'),
        $window = $(window);
    /*Detect IE*/
    var detectIE = function (callback) {
        isIE8 = !!navigator.userAgent.match(/MSIE 8.0/);
        isIE9 = !!navigator.userAgent.match(/MSIE 9.0/);
        isIE10 = !!navigator.userAgent.match(/MSIE 10.0/);
        isIE11 = !!navigator.userAgent.match(/rv:11.0/);

        if (isIE10) {
            $('html').addClass('ie10'); // detect IE10 version
        }

        if (isIE11) {
            $('html').addClass('ie11'); // detect IE11 version
        }

        if (isIE11 || isIE10 || isIE9 || isIE8) {
            $('html').addClass('ie'); // detect IE version
            if (typeof callback != 'undefined') callback();
        }
    };

    /*Scroll to top*/
    var scrollToTop = function (event) {
        if (event) event.preventDefault();
        $('html, body').stop().animate({
            scrollTop: 0
        }, 800);
    };

    /*Handle scroll to top*/
    var handleScroll = function () {
        $body.on('click', '[data-toggle="scroll-to-top"]', function (event) {
            event.preventDefault();
            scrollToTop();
        });
        $window.trigger('scroll');
    };

    return {
        detectIE: function (callback) {
            detectIE(callback);
        },
        showLoading: function(){
            $body.addClass('on-loading');
        },
        hideLoading: function(){
            $body.removeClass('on-loading');
        },
        handleScroll: function () {
            handleScroll();
        },
        scrollToTop: function (event) {
            scrollToTop(event);
        }
    };
}();