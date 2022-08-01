(function ($) {

	'use strict';

    $('.deposit-fund-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'deposit-fund-button', spinner: 'deposit-fund-spinner', message: 'deposit-fund-message'});
    });

    $('.login-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'login-button', spinner: 'login-spinner', message: 'login-message'});
    });

    $('.resend-verification-link-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'resend-verification-link-button', spinner: 'resend-verification-link-spinner', message: 'resend-verification-link-message'});
    });

    $('.signup-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'signup-button', spinner: 'signup-spinner', message: 'signup-message'});
    });

})(jQuery);
