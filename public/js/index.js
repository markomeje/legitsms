(function($) {

    'use strict';

    $('.dropdown-menu').click(function (event) {
        event.stopPropagation();
    });

})(jQuery);

function handleButton(button, spinner) {
    button.attr('disabled', false);
    spinner.addClass('d-none');
}

function handleErrors(errors) {
    $.each(errors, function(field, message) {
        var element = $('.'+field);
        var span = $('.'+field+'-error');
        element.addClass('is-invalid');
        span.html(message);
        element.focus(function() {
            element.removeClass('is-invalid');
            span.html('');
        });
    });
}

function handleForm(info = {}) {
    var form = info.form;
    var button = $('.'+info.button);
    var spinner = $('.'+info.spinner);
    var message = $('.'+info.message);
    button.attr('disabled');
    spinner.removeClass('d-none');
    message.hasClass('d-none') ? '' : message.fadeOut();

    $.ajax({
        method: form.attr('method'),
        url: form.attr('data-action'),
        data: form.serialize(),
        dataType: 'json',

        success: function(response) {
            if (response.status === 0) {
                if($.isEmptyObject(response.error)){
                    handleButton(button, spinner);
                    message.removeClass('d-none alert-success').addClass('alert-danger');
                    message.html(response.info).fadeIn();
                }else{
                    handleErrors(response.error);
                    handleButton(button, spinner);
                }
            }else if(response.status === 1) {
                message.removeClass('d-none alert-danger').addClass('alert-success');
                message.html(response.info).fadeIn();
                return window.location.href = response.redirect;

            }else {
                handleButton(button, spinner);
                alert('Network error. Try again.');
            }
        },

        error: function(error) {
            handleButton(button, spinner);
            alert('Unknown error. Try again.');
        },
    });
}

function handleAjax(info = {}) {
    if (confirm(info.that.attr('data-message') || 'Are you sure?')) {
        var button = $('.'+info.button);
        var spinner = $('.'+info.spinner);
        button.attr('disabled', true);
        spinner.removeClass('d-none');
        $.ajax({
            method: 'post',
            headers: {"Access-Control-Allow-Origin": "*"},
            crossDomain: true,
            url: info.that.attr('data-url'),
            dataType: 'json',

            success: function(response) {
                if (response.status === 0) {
                    alert(response.info);
                    handleButton(button, spinner)
                }else if(response.status === 1) {
                    alert(response.info);
                    spinner.addClass('d-none');
                    window.location.href = response.redirect;
                }else {
                    handleButton(button, spinner)
                    alert('Network error. Try again.');
                }
            },

            error: function() {
                handleButton(button, spinner)
                alert('Network error. Try again.');
            },
        });
    }
}

function uploader(data = {}) {
    var target = data.target;
    var id = target.attr('data-id');
    var input = $('.'+data.input);
    var loader = $('.'+data.loader);

    input.trigger('click');
    input.change(function(event) {
        loader.removeClass('d-none').fadeIn();
        var files = event.target.files
        var formData = new FormData();
        formData.append('image', files[0]);

        var request = $.ajax({
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            url: input.attr('data-url'),
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json'
        });

        request.done(function(response){
            if (response.status === 1) {
                var preview = $('.'+data.preview);
                preview.file = files[0];    
                var reader = new FileReader();
                reader.onload = (function(picture) { 
                    return (function(event) { 
                        picture.attr('src', event.target.result);
                        loader.addClass('d-none').fadeOut(); 
                    });
                })(preview);
                reader.readAsDataURL(files[0]);
                window.location.reload();
            }else {
                alert(response.info);
                loader.addClass('d-none').fadeOut();
            }
        });

        request.fail(function(response) {
            loader.addClass('d-none').fadeOut();
            alert('Unknown error. Try again.');
        });
    });
}

