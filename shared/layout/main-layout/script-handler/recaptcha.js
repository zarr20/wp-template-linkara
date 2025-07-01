var forms = document.querySelectorAll('form');
forms.forEach(function (form) {
    grecaptcha.ready(function () {
        grecaptcha.execute('6LfO81UiAAAAAGpbIhZxY5L-BdoWLIcZwLDmCHeY', {
            action: 'submit'
        }).then(function (token) {
            var recaptchaResponse = document.createElement('input');
            recaptchaResponse.type = 'hidden';
            recaptchaResponse.name = 'g-recaptcha-response';
            recaptchaResponse.value = token;
            form.appendChild(recaptchaResponse);
            // form.submit();
        }).catch(function (error) {
            console.error('reCAPTCHA error:', error);
        });
    });
});