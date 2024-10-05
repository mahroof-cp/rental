$(function() {

    app.options.datatables.ajax = {
        "url": $('#servicesList').data('url'),
        "type": "POST",
        "data": function(data) {
            data._token = _token;
            data.status = $('#services-status').val();
        }
    };
    app.options.datatables.columns = [
        { data: "DT_RowIndex", orderable: false, searchable: false },
        { data: "name_en", name: 'name_en', orderable: true, searchable: true },
        { data: "status", orderable: false, searchable: false },
        { data: "action", orderable: false, searchable: false },
    ];
    app.options.datatables.order = [
        [1, "asc"]
    ];
    window.dataTables[$('#servicesList').attr("id")] = $('#servicesList').DataTable(app.options.datatables);

});

$('#servicesFilterAttribute').on('submit', function(e) {
    e.preventDefault();
    dataTables['servicesList'].ajax.reload();
    return false;
});

$('.reset_search').click(function(e) {
    $('.select2').val(null).trigger('change');
    $('.searchform select').prop('selectedIndex', 0); //Sets the first option as selected
    dataTables['servicesList'].ajax.reload();
    return false;
});