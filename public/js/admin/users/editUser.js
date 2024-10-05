$(function() {

    'use strict';
    const wizardNumbered = document.querySelector('.formwizard');
    new Stepper(wizardNumbered, {
        linear: false
    });

    const userForm = document.getElementById('userForm');
    app.options.validation.fields = {
        name: {
            validators: {
                notEmpty: {
                    message: 'Please enter your name'
                },
            }
        },
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
        password_confirm: {
            validators: {
                identical: {
                    compare: function() {
                        return form.querySelector('[name="password"]').value;
                    },
                    message: 'The password and its confirm are not the same',
                }
            }
        },
        role_id: {
            validators: {
                notEmpty: {
                    message: 'Please enter your password'
                },
            }
        },
    };
    FormValidation.formValidation(userForm, app.options.validation);
});