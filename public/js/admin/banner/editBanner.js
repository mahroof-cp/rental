$(function() {
    app.options.validation.rules = {
        name: {
            required: true
        },
        file: {
            required: true
        },
    };
    app.options.validation.messages = {
        name: {
            required: "Please enter name",
        },
        file: {
            required: "Please choose file",
        },
    }
    $("#bannerForm").validate(app.options.validation);

    $('#bannerForm').on('reset', function(event) {
        setTimeout(function() {
            $('label').addClass('active');
        }, 1);
    });
});