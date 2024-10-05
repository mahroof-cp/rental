$(function() {
    if ($("#roles-list-datatable").length > 0) {
        app.options.datatables.ajax = {
            "url": $('#roles-list-datatable').data('url'),
            "type": "POST",
            "data": function(data) {
                data._token = _token;
                data.status = $('#role-status').val();
            }
        };
        app.options.datatables.columns = [
            { data: "DT_RowIndex", orderable: false, searchable: false },
            { data: "name", name: 'name', orderable: true, searchable: true },
            { data: "status", orderable: false, searchable: false },
            { data: "action", orderable: false, searchable: false },
        ];
        app.options.datatables.order = [
            [1, "asc"]
        ];
        window.dataTables[$('#roles-list-datatable').attr("id")] = $('#roles-list-datatable').DataTable(app.options.datatables);
    }
});
$('#roleFilterAttribute').on('submit', function(e) {
    e.preventDefault();
    dataTables['roles-list-datatable'].ajax.reload();
    return false;
});
$('.reset_search').click(function(e) {
    $('.select2').val(null).trigger('change');
    $('.searchform select').prop('selectedIndex', 0); //Sets the first option as selected
    dataTables['roles-list-datatable'].ajax.reload();
    return false;
});