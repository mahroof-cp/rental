/**
 * Config
 * -------------------------------------------------------------------------------------
 * ! IMPORTANT: Make sure you clear the browser local storage In order to see the config changes in the template.
 * ! To clear local storage: (https://www.leadshook.com/help/how-to-clear-local-storage-in-google-chrome-browser/).
 */

'use strict';

// JS global variables
let config = {
    colors: {
        primary: '#5a8dee',
        secondary: '#69809a',
        success: '#39da8a',
        info: '#00cfdd',
        warning: '#fdac41',
        danger: '#ff5b5c',
        dark: '#495563',
        black: '#000',
        white: '#fff',
        body: '#f2f2f6',
        headingColor: '#516377',
        axisColor: '#a8b1bb',
        borderColor: '#e9ecee'
    },
    colors_label: {
        primary: '#5a8dee29',
        secondary: '#69809a29',
        success: '#39da8a29',
        info: '#00cfdd29',
        warning: '#fdac4129',
        danger: '#ff5b5c29',
        dark: '#49556329'
    },
    colors_dark: {
        cardColor: '#283144',
        headingColor: '#d8deea',
        axisColor: '#8295ba',
        borderColor: '#36445d'
    },
    enableMenuLocalStorage: true // Enable menu state with local storage support
};

let assetsPath = document.documentElement.getAttribute('data-assets-path'),
    templateName = document.documentElement.getAttribute('data-template'),
    rtlSupport = true; // set true for rtl support (rtl + ltr), false for ltr only.


let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window._token = token.content;
} else {
    console.error(
        "CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"
    );
}
$(function() {
    $.ajaxSetup({
        beforeSend: function(xhr) {
            $("#loader").show();
        },
        complete: function(xhr) {
            $("#loader").hide();
        },
    });
});
/* Variables*/
window.dataTables = {};
window.app = {};
app.lang = {};
app.lang.datatables = {
    emptyTable: "No entries found",
    info: "Showing _START_ to _END_ of _TOTAL_ entries",
    infoEmpty: "Showing 0 to 0 of 0 entries",
    infoFiltered: "(filtered from _MAX_ total entries)",
    lengthMenu: "_MENU_",
    loadingRecords: "Loading...",
    processing: '<div class="dt-loader"></div>',
    search: '<div class="input-group"><span class="input-group-addon"><span class="fa fa-search"></span></span>',
    searchPlaceholder: "Search...",
    zeroRecords: "No matching records found",
    paginate: {
        first: "First",
        last: "Last",
        next: "Next",
        previous: "Previous",
    },
    aria: {
        sortAscending: " activate to sort column ascending",
        sortDescending: " activate to sort column descending",
    },
};
app.lang.select2 = {
    placeholder: "Please select",
};
app.options = {};
app.options.datatables = {
    language: app.lang.datatables,
    processing: true,
    responsive: true,
    serverSide: true,
    dom: "<'row'<'col m7'lB><'col m5'f>>rt<ip>",
    buttons: [{
        text: '<i class="fas fa-sync-alt"></i>',
        action: function(e, dt, node, config) {
            dt.ajax.reload();
        },
    }, ],
    createdRow: function(row, data, dataIndex) {
        $(row).data("id", data.id);
    },
};
app.options.reportsdatatables = {
    language: app.lang.datatables,
    processing: true,
    responsive: true,
    serverSide: true,
    scrollX: true,
    pageLength: 25,
    lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"],
    ],
    buttons: {
        buttons: [{
                extend: "excelHtml5",
                text: "Excel",
                className: "btn waves-effect waves-light mr-1",
            },
            {
                extend: "pdfHtml5",
                text: "Pdf",
                className: "btn waves-effect waves-light mr-1",
                orientation: "landscape",
                pageSize: "LEGAL",
            },
            {
                extend: "colvis",
                text: "Visibility",
                className: "btn waves-effect waves-light mr-1",
            },
        ],
    },
    dom: "<'row'<'col m1'l><'col m5'B><'col m6'f>>rt<'row'<'col m4'i><'col m7'p>>",
    createdRow: function(row, data, dataIndex) {
        $(row).data("id", data.id);
    },
};
app.options.select2 = {
    normal: {
        dropdownAutoWidth: true,
        placeholder: app.lang.select2.placeholder,
        width: "100%",
    },
    ajax: {
        dropdownAutoWidth: true,
        width: "100%",
        ajax: {
            dataType: "json",
            delay: 250,
            type: "GET",
            quietMillis: 50,
            processResults: function(data) {
                return {
                    results: data,
                };
            },
            cache: true,
        },
        placeholder: app.lang.select2.placeholder,
        // minimumInputLength: 1,
    },
};
app.options.stepper = {
    firstActive: 0,
    showFeedbackPreloader: true,
    autoFormCreation: true,
    stepTitleNavigation: true,
    feedbackPreloader: '<div class="spinner-layer spinner-blue-only">...</div>',
};
app.options.collapsible = {
    accordion: true,
};
app.options.quill = {};
app.options.quill.fontWhitelist = [
    "sofia",
    "slabo",
    "roboto",
    "inconsolata",
    "ubuntu",
];
app.options.quill.theme = "snow";
app.options.quill.modules = {
    htmlEditButton: {
        debug: false,
        msg: "Edit the content in HTML format",
        okText: "Ok",
        cancelText: "Cancel",
        buttonHTML: "&lt;&gt;",
        buttonTitle: "Show HTML source",
        editorModules: {},
    },
    formula: true,
    syntax: true,
    toolbar: [
        [{
                font: [],
            },
            {
                size: [],
            },
        ],
        ["bold", "italic", "underline", "strike"],
        [{
                color: [],
            },
            {
                background: [],
            },
        ],
        [{
                script: "super",
            },
            {
                script: "sub",
            },
        ],
        [{
                header: "1",
            },
            {
                header: "2",
            },
            "blockquote",
            "code-block",
        ],
        [{
                list: "ordered",
            },
            {
                list: "bullet",
            },
            {
                indent: "-1",
            },
            {
                indent: "+1",
            },
        ],
        [
            "direction",
            {
                align: [],
            },
        ],
        ["link", "image", "video", "formula"],
        ["clean"],
    ],
};
if ($(".validation-script").length) {
    app.options.validation = {
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: '',
                rowSelector: '.mb-3'
            }),
            submitButton: new FormValidation.plugins.SubmitButton(),

            defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
            autoFocus: new FormValidation.plugins.AutoFocus()
        },
        init: instance => {
            instance.on('plugins.message.placed', function(e) {
                if (e.element.parentElement.classList.contains('input-group')) {
                    e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                }
            });
        }
    };
}
app.options.datepicker = {
    autoClose: true,
    container: "body",
    onDraw: function() {
        // materialize select dropdown not proper working on mobile and tablets so we make it browser default select
        $(".datepicker-container")
            .find(".datepicker-select")
            .addClass("browser-default");
        $(".datepicker-container .select-dropdown.dropdown-trigger").remove();
    },
};

/*
 * Setup menu
 */
var menuBgDefault = false;

$(document).ready(function() {

    // scroll-bar
    if ($(".scroll-bar").length) {
        new PerfectScrollbar(".scroll-bar", {
            wheelSpeed: 2,
            wheelPropagation: false,
            minScrollbarLength: 20,
        });
    }

    // normal select2
    if ($(".select2").length) {
        $(".select2").each(function(index) {
            app.options.select2.normal.placeholder =
                $(this).data("placeholder");
            $(this).select2(app.options.select2.normal);
        });
    }

    //ajax select
    if ($(".select2-ajax").length) {
        $(".select2-ajax").each(function(index) {
            app.options.select2.ajax.placeholder = $(this).data("placeholder");
            app.options.select2.ajax.ajax.url = $(this).data("option-url");
            if ($(this).data("not")) {
                app.options.select2.ajax.ajax.data = function(params) {
                    return {
                        q: params.term,
                        not: $(this).data("not"),
                    };
                };
            }
            $(this).select2(app.options.select2.ajax);
        });
    }

    //datepicker
    if ($(".datepicker").length) {
        $(".datepicker").each(function(index) {
            app.options.datepicker.format = $(this).data("format");
            $(this).datepicker(app.options.datepicker);
        });
    }

    if (
        $("body").hasClass("vertical-modern-menu") ||
        $("body").hasClass("vertical-menu-nav-dark")
    ) {
        $(".menu-bg-color").hide();
    } else if (
        $("body").hasClass("vertical-gradient-menu") ||
        $("body").hasClass("vertical-dark-menu")
    ) {
        $(".menu-color").hide();
        menuBgDefault = true;
    } else if ($("body").hasClass("horizontal-menu")) {
        $(".menu-options").hide();
    }
    if ($("#sessionSuccess").length) {
        swal("Success!", $("#sessionSuccess").text(), "success");
        $("#sucess-msg").load(" #sucess-msg > *"); //to reload a div in app.blade
    }
    if (localStorage.getItem("success")) {
        swal("Success!", localStorage.getItem("success"), "success");
        $("#sucess-msg").load(" #sucess-msg > *"); //to reload a div in app.blade
        localStorage.clear();
    }
    if ($("#sessionError").length) {
        swal("Error!", $("#sessionError").text(), "error");
    }
    if (localStorage.getItem("error")) {
        swal("Error!", localStorage.getItem("error"), "error");
        localStorage.clear();
    }
});

$.loadRemoteDom = function(url) {
    $.ajax({
        method: "GET",
        url: url,
        success: function(data) {
            $("#model-area").html(data.html);
            $.each(data.scripts, function(key, script) {
                $.getScript(script);
            });
        },
    });
};

$(document).on("click", ".update-list-status", function() {
    var elem = this;
    swal({
        title: "Are you sure?",
        text: "Status will be updated!",
        icon: "warning",
        buttons: {
            cancel: true,
            change: "Yes, Change It",
        },
    }).then((value) => {
        if (value == "change") {
            $.ajax({
                url: $(elem).data("url"),
                type: "post",
                dataType: "json",
                data: {
                    _token: _token,
                    id: $(elem).data("id"),
                },
                success: function(data) {
                    if (data.status == 1) {
                        swal("Changed!", "Status updated!", "success");
                        if ($(elem).hasClass("red")) {
                            $(elem).removeClass("red").addClass("green");
                            $(elem)
                                .children("span")
                                .removeClass("red-text")
                                .addClass("green-text")
                                .text("Active");
                        } else {
                            $(elem).removeClass("green").addClass("red");
                            $(elem)
                                .children("span")
                                .removeClass("green-text")
                                .addClass("red-text")
                                .text("Inactive");
                        }
                        dataTables[
                            $(elem).parents("table").attr("id")
                        ].ajax.reload();
                    } else {
                        swal("Failed!", "Failed to Update status!", "error");
                    }
                },
            });
        }
    });
});

$(document).on("click", ".delete-list", function() {
    var elem = this;
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this details!",
        icon: "warning",
        buttons: {
            cancel: true,
            delete: "Yes, Delete It",
        },
    }).then((value) => {
        if (value == "delete") {
            $.ajax({
                url: $(elem).data("src"),
                type: "get",
                dataType: "json",
                success: function(data) {
                    if (data.status == 1) {
                        swal("Deleted!", data.message, "success");
                        dataTables[
                            $(elem).parents("table").attr("id")
                        ].ajax.reload();
                    } else {
                        swal("Failed!", data.message, "error");
                    }
                },
            });
        }
    });
});

/**to solve double click issue */
function clickAndDisable(link) {
    console.log("here");
    link.onclick = function(event) {
        event.preventDefault();
    };
}

$(document).on("click", "form.searchform .btn-reset", function() {
    $(this).parents("form").find("select.select2-ajax").empty();
    $(this)
        .parents("form")
        .find("select.select2, select.select2-ajax")
        .change();
});