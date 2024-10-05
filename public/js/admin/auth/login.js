$(function() {

    'use strict';
    const loginForm = document.getElementById('loginForm');
    app.options.validation.fields = {
        email: {
            validators: {
                notEmpty: {
                    message: 'Please enter your email'
                },
                emailAddress: {
                    message: 'Please enter valid email address'
                }
            }
        },
        password: {
            validators: {
                notEmpty: {
                    message: 'Please enter your password'
                },
                stringLength: {
                    min: 6,
                    message: 'Password must be more than 6 characters'
                }
            }
        },
    };
    console.log(app.options.validation);
    FormValidation.formValidation(loginForm, app.options.validation);
});