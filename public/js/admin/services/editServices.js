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
    const serviceeditForm = document.getElementById('serviceeditForm');
    app.options.validation.fields = {
        name_en: {
            validators: {
                notEmpty: {
                    message: 'Please enter your name (english)'
                },
            }
        },
        name_ar: {
            validators: {
                notEmpty: {
                    message: 'Please enter your name (arabic)'
                },
            }
        },
    };
    FormValidation.formValidation(serviceeditForm, app.options.validation);
});