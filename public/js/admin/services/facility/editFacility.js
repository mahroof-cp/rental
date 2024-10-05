(function(window, document, $) {
    'use strict';

    var Font = Quill.import('formats/font');
    Font.whitelist = app.options.quill.fontWhitelist;
    Quill.register(Font, true);
    Quill.register("modules/htmlEditButton", htmlEditButton);

    $(".quill-editor").each(function(index) {
        var editor = new Quill(this, {
            bounds: this,
            modules: app.options.quill.modules,
            theme: app.options.quill.theme
        });
        // add browser default class to quill select 
        var quillSelect = $("select[class^='ql-'], input[data-link]");
        quillSelect.addClass("browser-default");

        editor.on('text-change', function(delta, oldDelta, source) {
            $(editor.container.parentElement).find('.description').val(editor.container.firstChild.innerHTML);
        });
    });
})(window, document, jQuery);

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
$(function() {

    'use strict';
    const wizardNumbered = document.querySelector('.formwizard');
    new Stepper(wizardNumbered, {
        linear: false
    });

    const userForm = document.getElementById('userForm');
    app.options.validation.fields = {
       //
    };
    FormValidation.formValidation(userForm, app.options.validation);
});