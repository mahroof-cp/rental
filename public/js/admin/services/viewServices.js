$(function() {

    app.options.datatables.ajax = {
        "url": $('#servicesFacilityList').data('url'),
        "type": "POST",
        "data": function(data) {
            data._token = _token;
            data.service_id =  $('#services_id').val(); ;
            data.status = $('#services-status').val();
        }
    };
    app.options.datatables.columns = [
        { data: "DT_RowIndex", orderable: false, searchable: false },
        { data: "title_en", name: 'title_en', orderable: true, searchable: true },
        { data: "status", orderable: false, searchable: false },
        { data: "action", orderable: false, searchable: false },
    ];
    app.options.datatables.order = [
        [1, "asc"]
    ];
    window.dataTables[$('#servicesFacilityList').attr("id")] = $('#servicesFacilityList').DataTable(app.options.datatables);

});

$('#servicesFacilityList').on('submit', function(e) {
    e.preventDefault();
    dataTables['servicesFacilityList'].ajax.reload();
    return false;
});

$('.reset_search').click(function(e) {
    $('.select2').val(null).trigger('change');
    $('.searchform select').prop('selectedIndex', 0); //Sets the first option as selected
    dataTables['servicesFacilityList'].ajax.reload();
    return false;
});

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
        title: {
            required: true
        },
    };
    app.options.validation.messages = {
        title: {
            required: "Please enter title",
        },
    };
    $("#servicesForm").validate(app.options.validation);

    $('#servicesForm').on('reset', function(event) {
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

    const servicehours = document.getElementById('servicehours');
    app.options.validation.fields = {
        mon: {
            validators: {
                notEmpty: {
                    message: 'Please enter your title'
                },
            }
        },
        tus: {
            validators: {
                notEmpty: {
                    message: 'Please enter your title'
                },
            }
        },
        wed: {
            validators: {
                notEmpty: {
                    message: 'Please enter your title'
                },
            }
        },
        thur: {
            validators: {
                notEmpty: {
                    message: 'Please enter your title'
                },
            }
        },
        fri: {
            validators: {
                notEmpty: {
                    message: 'Please enter your title'
                },
            }
        },
        sat: {
            validators: {
                notEmpty: {
                    message: 'Please enter your title'
                },
            }
        },
        sun: {
            validators: {
                notEmpty: {
                    message: 'Please enter your title'
                },
            }
        },
    };
    FormValidation.formValidation(servicehours, app.options.validation);
});