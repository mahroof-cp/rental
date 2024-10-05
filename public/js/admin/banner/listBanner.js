$(function() {

    app.options.datatables.ajax = {
        "url": $('#bannerList').data('url'),
        "type": "POST",
        "data": function(data) {
            data._token = _token;
            data.status = $('#banner-status').val();
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
    window.dataTables[$('#bannerList').attr("id")] = $('#bannerList').DataTable(app.options.datatables);

});

$('#bannerFilterAttribute').on('submit', function(e) {
    e.preventDefault();
    dataTables['bannerList'].ajax.reload();
    return false;
});

$('.reset_search').click(function(e) {
    $('.select2').val(null).trigger('change');
    $('.searchform select').prop('selectedIndex', 0); //Sets the first option as selected
    dataTables['bannerList'].ajax.reload();
    return false;
});