$(function() {

    app.options.datatables.ajax = {
        "url": $('#enquiryList').data('url'),
        "type": "POST",
        "data": function(data) { data._token = _token; }
    };
    app.options.datatables.columns = [
        { data: "DT_RowIndex", name: 'created_at', orderable: false, searchable: false },
        { data: "name", name: 'name', orderable: true, searchable: true },
        { data: "email", name: 'email', orderable: true, searchable: true },
        { data: "phone", name: 'phone', orderable: true, searchable: true },
        { data: "message", name: 'message', orderable: true, searchable: true },
        { data: "action", orderable: false, searchable: false },
    ];
    app.options.datatables.order = [
        [0, "desc"]
    ];
    window.dataTables[$('#enquiryList').attr("id")] = $('#enquiryList').DataTable(app.options.datatables);

});