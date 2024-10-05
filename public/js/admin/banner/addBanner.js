$(function() {

    const bannerForm = document.getElementById('bannerForm');
    app.options.validation.fields = {
        name: {
            validators: {
                notEmpty: {
                    message: 'Please enter your name'
                },
            }
        },
    };
    FormValidation.formValidation(bannerForm, app.options.validation);
});