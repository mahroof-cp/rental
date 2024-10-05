@section('title','Add Banner')

@push('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendor/libs/select2/select2.css')}}">
<link rel="stylesheet" href="{{asset('vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
@endpush

@push('style')
<link rel="stylesheet" href="{{asset('css/admin/banner/addBanner.css')}}">
@endpush

@push('vendor-script')
<script src="{{asset('vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}" class="validation-script"></script>
<script src="{{asset('vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
<script src="{{asset('vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
@endpush

@push('script')
<script src="{{asset('js/admin/banner/addBanner.js')}}"></script>
@endpush

<x-admin-layout>

    <x-breadcrumbs :breadcrumbs="$breadcrumbs"></x-breadcrumbs>

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin_banner_save')}}" method="post" enctype="multipart/form-data" class="mb-3" id="bannerForm">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <label for="name" class="mandatory">@lang('Name')<span class="red-text">*</span></label>
                        <input type="text" value="{{old('name')}}" class="form-control" name="name" id="name">
                        @error('name')<small class="form-text red-text text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label for="formFile" class="form-label">Images</label>
                        <input class="form-control" type="file" id="file" name="file[]" multiple>
                        @error('file')<small class="form-text text-danger red-text">{{ $message }}</small>@enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 display-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-success float-end ms-2">Create</button>
                        <a href="{{route('admin_banner_list')}}" class="btn btn-primary float-end">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>