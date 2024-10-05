@section('title', 'Services')

@push('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/libs/select2/select2.css') }}">
@endpush

@push('style')
    <link rel="stylesheet" href="{{ asset('css/admin/services/listServices.css') }}">
@endpush

@push('vendor-script')
    <script src="{{ asset('vendor/libs/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
    <script src="{{ asset('vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
@endpush

@push('script')
    <script src="{{ asset('js/admin/services/listServices.js') }}"></script>
@endpush

<x-admin-layout>

    <x-breadcrumbs :breadcrumbs="$breadcrumbs">
    </x-breadcrumbs>

    <div class="card mb-4">
        <div class="card-body">
            <form id="servicesFilterAttribute" class="searchform" class="searchform">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="select2Basic" class="form-label">Status</label>
                        <select class="select2 form-select form-select-lg" id="services-status">
                            <option value="">All</option>
                            <option value="0">Inactive</option>
                            <option value="1">Active</option>
                        </select>
                    </div>
                    <div class="show-btn">
                        <button type="submit" class="waves-effect waves dark btn btn-primary">Show</button>
                        <button class="red btn btn-danger reset_search ">Reset</button>
                        @can('servicesr_create')
                            <a class="btn waves-effect waves-light btn-info" href="{{ route('admin_services_add') }}">
                                <i class='bx bx-plus'></i><span class="hide-on-small-onl">Add</span>
                            </a>
                        @endcan
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card p-3">
        <div class="card-datatable text-nowrap">
            <table class="datatables-ajax table table-bordered" id="servicesList" class="table"
                data-url="{{ route('admin_services_table') }}">
                <thead>
                    <tr>
                        <th>SL No.</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
