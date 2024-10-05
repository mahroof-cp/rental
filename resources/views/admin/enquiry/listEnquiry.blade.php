@section('title','Enquiries')

@push('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
@endpush

@push('style')
<link rel="stylesheet" href="{{asset('css/admin/enquiry/listEnquiry.css')}}">
@endpush

@push('vendor-script')
<script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
@endpush

@push('script')
<script src="{{asset('js/admin/enquiry/listEnquiry.js')}}"></script>
@endpush

<x-admin-layout>
    <x-breadcrumbs :breadcrumbs="$breadcrumbs">
    </x-breadcrumbs>

    <div class="col s12">
        <div class="container">
            {{-- Content --}}
            <div class="section">
                <div class="card p-3">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12">
                                <table id="enquiryList" class="table" data-url="{{route('admin_enquiry_table')}}">
                                    <thead>
                                        <tr>
                                            <th width="1">#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Message</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-overlay"></div>
    </div>
</x-admin-layout>
