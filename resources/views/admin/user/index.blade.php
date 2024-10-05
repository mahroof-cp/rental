@section('title', 'List Users')

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
                                @if(auth()->user()->role->hasPermission("user_create"))
                                    <a class="btn waves-effect waves-light btn-success" href="{{ route('admin_user_create_update') }}" >
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
                        <button class="btn waves-effect waves-light btn-primary" onclick="getReport();">Get Report</button>
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
                                <th>Name</th>
                                <th>Mail</th>
                                <th>Status</th>
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
    <span class='d-none datatable_status'>{{ route('admin_user_action', ['ID', 'STATUS']) }}</span>
</x-admin-layout>

<script type="text/javascript">
    $(document).ready(function() {
        loadTable("");
    });

    function getReport() {
        if ($('#status').val() != "") {
            active = $('#status').val();
        } else {
            active = 2;
        }

        var params = "/" + active;

        loadTable(params);
    }

    function loadTable(params) {
        if ($.fn.DataTable.isDataTable('#datatable')) {
            $('#datatable').DataTable().destroy();
        }

        $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin_user_list') }}" + params,
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'status', name: 'status', searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center"},
            ],
            "order": [[1, "desc"]],
            paging: false
        });
    }
</script>


