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