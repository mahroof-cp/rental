@section('title','Dashboard')

@push('vendor-style')
@endpush

@push('style')
<link rel="stylesheet" href="{{asset('css/admin/dashboard/dashboard.css')}}">
@endpush

@push('vendor-script')
@endpush

@push('script')
<script src="{{asset('js/admin/dashboard/dashboard.js')}}"></script>
@endpush

<x-admin-layout>

</x-admin-layout>