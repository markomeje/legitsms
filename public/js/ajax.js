(function ($) {

	'use strict';

    $('.delete-staff').on('click', function() {
        handleAjax({that: $(this), button: 'staff-button', spinner: 'staff-spinner'});    
    });

    $('.verify-sms-prompt').on('click', function() {
        handleAjax({that: $(this), button: 'verify-sms-button', spinner: 'verify-sms-spinner'});    
    });

    $('.read-sms-prompt').on('click', function() {
        handleAjax({that: $(this), button: 'read-sms-button', spinner: 'read-sms-spinner'});    
    });

})(jQuery);
