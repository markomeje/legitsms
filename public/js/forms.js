(function ($) {

	'use strict';

    $('.add-legal-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'add-legal-button', spinner: 'add-legal-spinner', message: 'add-legal-message'});
    });

    $('.edit-legal-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'edit-legal-button', spinner: 'edit-legal-spinner', message: 'edit-legal-message'});
    });

    $('.add-country-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'add-country-button', spinner: 'add-country-spinner', message: 'add-country-message'});
    });

    $('.edit-country-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'edit-country-button', spinner: 'edit-country-spinner', message: 'edit-country-message'});
    });

    $('.add-social-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'add-social-button', spinner: 'add-social-spinner', message: 'add-social-message'});
    });

    $('.edit-social-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'edit-social-button', spinner: 'edit-social-spinner', message: 'edit-social-message'});
    });

    $('.reset-password-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'reset-password-button', spinner: 'reset-password-spinner', message: 'reset-password-message'});
    });

    $('.forgot-password-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'forgot-password-button', spinner: 'forgot-password-spinner', message: 'forgot-password-message'});
    });

    $('.contact-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'contact-button', spinner: 'contact-spinner', message: 'contact-message'});
    });

    $('.edit-faq-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'edit-faq-button', spinner: 'edit-faq-spinner', message: 'edit-faq-message'});
    });

    $('.add-faq-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'add-faq-button', spinner: 'add-faq-spinner', message: 'add-faq-message'});
    });

    $('.add-website-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'add-website-button', spinner: 'add-website-spinner', message: 'add-website-message'});
    });

    $('.edit-website-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'edit-website-button', spinner: 'edit-website-spinner', message: 'edit-website-message'});
    });

    $('.update-personal-form').submit(function(event){
        event.preventDefault();
        handleForm({form: $(this), button: 'update-personal-button', spinner: 'update-personal-spinner', message: 'update-personal-message'});
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
