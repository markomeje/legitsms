(function ($) {

	'use strict';

    $('.delete-website-prompt').on('click', function() {
        handleAjax({that: $(this), button: 'website-button', spinner: 'website-spinner'});    
    });

    $('.blacklist-prompt').on('click', function() {
        handleAjax({that: $(this), button: 'blacklist-button', spinner: 'blacklist-spinner'});    
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
