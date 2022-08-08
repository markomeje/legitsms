(function ($) {

	'use strict';

    $('.add-website-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'add-website-button', spinner: 'add-website-spinner', message: 'add-website-message'});
    });

    $('.read-sms-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'read-sms-button', spinner: 'read-sms-spinner', message: 'read-sms-message'});
    });

    $('.generate-number-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'generate-number-button', spinner: 'generate-number-spinner', message: 'generate-number-message'});
    });

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
