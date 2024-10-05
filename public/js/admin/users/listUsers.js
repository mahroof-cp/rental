$(document).ready(function() {
    if ($("#users-list-datatable").length > 0) {
        app.options.datatables.ajax = {
            "url": $('#users-list-datatable').data('url'),
            "type": "POST",
            "data": function(data) {
                data._token = _token;
                data.status = $('#user-status').val();
            }
        };
        app.options.datatables.columns = [
            { data: "DT_RowIndex", orderable: false, searchable: false },
            { data: "name", name: "name", orderable: true, searchable: true },
            { data: "status", orderable: false, searchable: false },
            { data: "action", orderable: false, searchable: false },
        ];
        window.dataTables[$('#users-list-datatable').attr("id")] = $('#users-list-datatable').DataTable(app.options.datatables);
    }
});

$('#userFilterAttribute').on('submit', function(e) {
    e.preventDefault();
    dataTables['users-list-datatable'].ajax.reload();
    return false;
});

$('.reset_search').click(function(e) {
    $('.select2').val(null).trigger('change');
    $('.searchform select').prop('selectedIndex', 0); //Sets the first option as selected
    $('#division_id').empty();
    $('#branch_id').empty();
    dataTables['users-list-datatable'].ajax.reload();
    return false;
});