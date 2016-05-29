<script src='//www.google.com/recaptcha/api.js?onload=onloadGoogleCaptchaCallback&render=explicit'></script>
<script type="text/javascript">
    var onloadGoogleCaptchaCallback = function () {
        if (document.getElementById('contactBoxCaptcha')) {
            grecaptcha.render('contactBoxCaptcha', {
                'sitekey': ' {{ $CMSSettings['google_captcha_site_key'] }}',
                'theme': 'light'
            });
        }
    };
</script>