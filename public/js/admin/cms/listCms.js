$(function() {
    app.options.datatables.ajax = {
        url: $("#cmsList").data("url"),
        type: "POST",
        data: function(data) {
            data._token = _token;
        },
    };
    app.options.datatables.columns = [
        { data: "DT_RowIndex", orderable: false, searchable: false },
        { data: "name", orderable: true, searchable: true, },
        { data: "title", orderable: true, searchable: true, },
        { data: "action", orderable: false, searchable: false },
    ];
    app.options.datatables.order = [
        [1, "asc"]
    ];
    window.dataTables[$("#cmsList").attr("id")] = $("#cmsList").DataTable(app.options.datatables);
});