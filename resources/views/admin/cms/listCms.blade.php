@section('title','Cms Contents')

@push('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendor/libs/select2/select2.css')}}">
@endpush

@push('style')
<link rel="stylesheet" href="{{asset('css/admin/cms/listCms.css')}}">
@endpush

@push('vendor-script')
<script src="{{asset('vendor/libs/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('vendor/libs/datatables-responsive/datatables.responsive.js')}}"></script>
<script src="{{asset('vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js')}}"></script>
<script src="{{asset('vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
@endpush

@push('script')
<script src="{{asset('js/admin/cms/listCms.js')}}"></script>
@endpush

<x-admin-layout>

    <x-breadcrumbs :breadcrumbs="$breadcrumbs">
        <a class="btn waves-effect waves-light breadcrumbs-btn float-end btn-info" href="{{route('admin_cms_add')}}">
            <i class='bx bx-plus'></i><span class="hide-on-small-onl">Add</span>
        </a>
    </x-breadcrumbs>
    <div class="card p-3">
        <div class="card-datatable text-nowrap">
            <table class="datatables-ajax table table-bordered" id="cmsList" data-url="{{route('admin_cms_table')}}">
                <thead>
                    <tr>
                        <th width="1">#</th>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
