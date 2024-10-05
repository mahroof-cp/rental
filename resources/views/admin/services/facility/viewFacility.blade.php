@section('title','View Facility')

@push('vendor-style')
@endpush

@push('style')
<link rel="stylesheet" href="{{asset('css/admin/category/viewCategory.css')}}">
@endpush

@push('vendor-script')
@endpush

@push('script')
<script src="{{asset('js/admin/services/facility/viewFacility')}}"></script>
@endpush
<x-admin-layout>

    <x-breadcrumbs :breadcrumbs="$breadcrumbs"></x-breadcrumbs>

    <div class="col s12">
        <div class="container">
            {{-- Content --}}
            <div class="section">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s6 input-field">
                                <div class="col  s12">
                                    <label>Title (English)</label>
                                </div>
                                <div class="col s12">
                                    {{$facility->title_en }}
                                </div>
                            </div>
                            <div class="col s6 input-field">
                                <div class="col s12">
                                    <label>Title (Arabic)</label>
                                </div>
                                <div class="col s12">
                                    {{$facility->title_ar }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6 input-field">
                                <div class="col s12">
                                    <label> Description (English)</label>
                                </div>
                                <div class="col s12">
                                    {{$facility->description_en }}
                                </div>
                            </div>
                            <div class="col s6 input-field">
                                <div class="col s6">
                                    <label> Description (Arabic)</label>
                                </div>
                                <div class="col s6">
                                    {{$facility->description_ar }}
                                </div>
                            </div>
                        </div
                        <div class="row">
                            <div class="col s6 input-field">
                                <div class="col s12">
                                    <label>  Icon</label>
                                </div>
                                <div class="col s12">
                                    {{$facility->icon }}
                                </div>
                            </div>
                            <div class="col s6 input-field">
                                <div class="switch">
                                    <label for="status">
                                        @lang('Status')
                                    </label>
                                    <label>
                                        <span>{{ $facility->status ? "Active" : "Inactive" }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>