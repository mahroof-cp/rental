@section('title','View Banner')

@push('style')
<link rel="stylesheet" href="{{asset('css/admin/banner/viewBanner.css')}}">
@endpush

@push('script')
<script src="{{asset('js/admin/banner/viewBanner.js')}}"></script>
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
                                <div class="col s12">
                                    <label>Name</label>
                                </div>
                                <div class="col s12">
                                    {{$banner->name }}
                                </div>
                            </div>
                            <div class="col s6 input-field">
                                <div class="col s12">
                                    <label>Status</label>
                                </div>
                                <div class="col s12">
                                    {{$banner->status==1 ? 'Active' : 'Inactive'}}
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col s6 input-field">
                                <div class="col s12">
                                    <label>Image</label>
                                </div>
                                <div class="col s12">
                                    <img class="preview" src="{{Storage::disk('rentel')->url($banner->file)}}" alt="" width="100px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>