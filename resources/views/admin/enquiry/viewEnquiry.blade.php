@section('title','View Enquiries')

@push('style')
<link rel="stylesheet" href="{{asset('css/admin/enquiry/viewenquiry.css')}}">
@endpush

@push('script')
<script src="{{asset('js/admin/enquiry/viewEnquiry.js')}}"></script>
@endpush
<x-admin-layout>

    <x-breadcrumbs :breadcrumbs="$breadcrumbs">
    </x-breadcrumbs>

    <div class="col s12">
        <div class="container">
            {{-- Content --}}
            <div class="section">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s6 input-field">
                                <div class="col s12">
                                    <label>Name</label>
                                </div>
                                <div class="col s12">
                                    {{$enquiry->name }}
                                </div>
                            </div>
                            <div class="col s6 input-field">
                                <div class="col s12">
                                    <label>Email</label>
                                </div>
                                <div class="col s12">
                                    {{$enquiry->email}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6 input-field">
                                <div class="col s12">
                                    <label>Phone</label>
                                </div>
                                <div class="col s12">
                                    {{$enquiry->phone }}
                                </div>
                            </div>
                            <div class="col s6 input-field">
                                <div class="col s12">
                                    <label>Message</label>
                                </div>
                                <div class="col s12">
                                    {{$enquiry->message}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>