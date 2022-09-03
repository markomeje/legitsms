(function ($) {

	'use strict';

    $('.delete-country-prompt').on('click', function() {
        handleAjax({that: $(this), button: 'country-button', spinner: 'country-spinner'});    
    });

    $('.delete-website-prompt').on('click', function() {
        handleAjax({that: $(this), button: 'website-button', spinner: 'website-spinner'});    
    });

    $('.delete-social-prompt').on('click', function() {
        handleAjax({that: $(this), button: 'social-button', spinner: 'social-spinner'});    
    });

    $('.delete-faq-prompt').on('click', function() {
        handleAjax({that: $(this), button: 'faq-button', spinner: 'faq-spinner'});    
    });

    $('.verify-sms-prompt').on('click', function() {
        handleAjax({that: $(this), button: 'verify-sms-button', spinner: 'verify-sms-spinner'});    
    });

    $('.read-sms-prompt').on('click', function() {
        handleAjax({that: $(this), button: 'read-sms-button', spinner: 'read-sms-spinner'});    
    });

})(jQuery);
