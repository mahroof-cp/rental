@section('title', 'List Banks')

<x-admin-layout>
    <x-breadcrumbs :breadcrumbs="$breadcrumbs"></x-breadcrumbs>
    <div class="row p-3">
        <div class="card">
            <div class="card-header">
                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <h4>Reports</h4>
                        </div>
                        <div class="col-4 d-flex justify-content-end">
                            <div class="card-tools">
                                @if(auth()->user()->role->hasPermission("bank_create"))
                                <a class="btn waves-effect waves-light btn-success" href="{{ route('admin_bank_create_update') }}" >
                                    <i class='bx bx-plus'></i><span class="hide-on-small-onl">New</span>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="from_date">From Date:</label>
                            <input type="text" class="form-control form-control-border" id="from_date" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="to_date">To Date:</label>
                            <input type="text" class="form-control form-control-border" id="to_date" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select class="form-select" name="is_active" id="status">
                                <option value="">ALL</option>
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="col-md-12">
                    <div class="form-group text-right">
                        @if(auth()->user()->role->hasPermission("bank_export"))
                        <button class="btn waves-effect waves-light btn-danger" onclick="getReport(1);">Export</button>
                        @endif
                        <button class="btn waves-effect waves-light btn-primary" onclick="getReport(0);">Get Report</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <th>SL No.</th>
                                <th>Unique ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                                </thead>
                                <tbody id="reorder_row">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <span class='d-none datatable_status'>{{ route('admin_bank_action', ['ID', 'STATUS']) }}</span>
</x-admin-layout>

<script type="text/javascript">
    $(document).ready(function() {
        loadTable("");
        $('.form-control-border').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd',
        });
    });

    function getReport(export_data) {
        if ($('#from_date').val() != "") {
            from_date = $('#from_date').val();
        } else {
            from_date = 0;
        }
        if ($('#to_date').val() != "") {
            to_date = $('#to_date').val();
        } else {
            to_date = 0;
        }
        if ($('#status').val() != "") {
            active = $('#status').val();
        } else {
            active = 2;
        }

        var params = "/" + from_date + "/" + to_date + "/" + active;

        if(export_data == 1) {
            window.open("{{ route('admin_bank_list') }}" + params + "/1");
        } else {
            loadTable(params);
        }
    }

    function loadTable(params) {
        if ($.fn.DataTable.isDataTable('#datatable')) {
            $('#datatable').DataTable().destroy();
        }

        $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin_bank_list') }}" + params,
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'unique_id', name: 'unique_id'},
                {data: 'name', name: 'name'},
                {data: 'status', name: 'status', searchable: false},
                {data: 'created_at', name: 'created_at', searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center"},
            ],
            "order": [[4, "desc"]],
            paging: false
        });
    }
</script>


